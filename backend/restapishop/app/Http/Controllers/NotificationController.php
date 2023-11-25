<?php

namespace App\Http\Controllers;

use App\Events\PodcastProcessed;
use App\Http\Resources\NotificationResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Notifications;
use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    use HttpResponses;

    public function getNotifications()
    {
        $notifications = Notifications::where('user_id', 1)->get();
        $notificationResources = NotificationResource::collection($notifications);

        return $this->successResponse($notificationResources, 'get notifications');
    }

    public function readNotification(Request $request)
    {
        $notifications = Notifications::find($request->id);

        $notifications->update([
            'read_at' => now()
        ]);

        return $this->successResponse('', 'read notifications');
    }

    public function sendNotifications(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = 'fe7dH44JLkbKlgCujqbI6_:APA91bHYgxDcVW303yzw9crs81ZByf3lQThX6ptHoFFC3rY19s8oirUDrxX-Uwyg2uABrEIFPtTKw7q4Inr40ERmYHFL5F27xrHH6VvWbQKJaQa2j1qKLT9lYDCvo6jcy6WWj1efOoEr';

        $serverKey = 'AAAAgSKNZBU:APA91bEb825yeW306r7Kv7d4GV_-LIIFAwtt9X6RfEMGrAQAVYWt6E-8OxadGESbetNirTuymqk0RozkjUJ_ZDpF2UStOqZrsPemwMu0arWLKKmC-nwLgZHbdyNbPySN5OjFUH1hNn1m'; // ADD SERVER KEY HERE PROVIDED BY FCM

        $data = [
            'registration_ids' => array($FcmToken),
            "notification" => [
                "title" => "TSC-Shop Thông Báo",
                "body" => $request->data,
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        // FCM response

        $notification = Notifications::create([
            'user_id' => auth()->user()->id,
            'read_at' => null,
            'data' => $request->data,
            'type' => 'info',
        ]);

        broadcast(new PodcastProcessed($notification));


        return $this->successResponse('', 'send notifications successfully');

    }
}
