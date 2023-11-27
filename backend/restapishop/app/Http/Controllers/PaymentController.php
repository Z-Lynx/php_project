<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;
use App\Models\Carts;
use Illuminate\Support\Facades\Log;
use App\Helpers\FCMNotification;
use App\Models\User;


class PaymentController extends Controller
{
    public function vnpay_payment(Request $request, string $id)
    {
        $cart = Carts::where('user_id', $id)->get();

        $totalPrice = 0;

        foreach ($cart as $cartItem) {
            $totalPrice += $cartItem->price;
        }

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, 3);

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/api/vnpay-payment/" . $id . "/callback";
        $vnp_TmnCode = "EJ9D8IVZ";
        $vnp_HashSecret = "RXFAIQOVBDJHLFYTHUQGOHZCDLAVUREW";

        $vnp_TxnRef = "TSC" . $randomString . mt_rand(100, 999);
        $vnp_OrderInfo = "Thanh Toán Đơn Hàng";
        $vnp_OrderType = "TSC Shop";
        $vnp_Amount = $totalPrice * 24000 * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpay_payment_callback(Request $request, string $id)
    {
        $cart = Carts::where('user_id', $id)->get();

        $totalPrice = 0;

        foreach ($cart as $cartItem) {
            $totalPrice += $cartItem->price;
        }

        foreach ($cart as $cartItem) {
            Bills::create([
                'vn_pay_code' => $request['vnp_TxnRef'],
                'user_id' => $id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'total_amount' => $cartItem->price,
                'status' => 'thanh_toan_thanh_cong',
            ]);

            Carts::find($cartItem->id)->delete();
        }

        $message = array(
            '00' => 'Giao dịch thành công',
            '07' => 'Giao dịch bị nghi ngờ',
            '09' => 'Thẻ/Tài khoản chưa đăng ký dịch vụ InternetBanking',
            '10' => 'Xác thực thông tin thẻ/tài khoản sai quá 3 lần',
            '11' => 'Đã hết hạn chờ thanh toán',
            '12' => 'Thẻ/Tài khoản bị khóa',
            '13' => 'Sai mật khẩu xác thực giao dịch (OTP)',
            '24' => 'Khách hàng hủy giao dịch',
            '51' => 'Tài khoản không đủ số dư',
            '65' => 'Vượt quá hạn mức giao dịch trong ngày',
            '75' => 'Ngân hàng thanh toán đang bảo trì',
            '79' => 'Nhập sai mật khẩu thanh toán quá số lần quy định',
            '99' => 'Các lỗi khác'
        );

        $vnp_ResponseCode = $request['vnp_ResponseCode'];

        $fcmNotification = new FCMNotification();
        $fcmNotification->sendNotification('Đơn Hàng ' . $request['vnp_TxnRef'] . 'Thanh Toán Thành Công', User::find($id));

        $request['message'] = isset($message[$vnp_ResponseCode]) ? $message[$vnp_ResponseCode] : 'Mã lỗi không hợp lệ';
        return view('callback', [
            'response' => $request->all(),
        ]);
    }

}
