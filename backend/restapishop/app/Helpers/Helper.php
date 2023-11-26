<?php
namespace App\Helpers;

class FCMNotification{
    private $serverKey ='AAAAgSKNZBU:APA91bEb825yeW306r7Kv7d4GV_-LIIFAwtt9X6RfEMGrAQAVYWt6E-8OxadGESbetNirTuymqk0RozkjUJ_ZDpF2UStOqZrsPemwMu0arWLKKmC-nwLgZHbdyNbPySN5OjFUH1hNn1m'; // ADD SERVER KEY HERE PROVIDED BY FCM

    public function sendNotification($body, $token){
        $data = [
            'registration_ids' => array($token),
            "notification" => [
                "title" => "TSC-Shop Thông Báo",
                "body" => $body,
            ]
        ];

        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $this->serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        curl_exec($ch);
        curl_close($ch);

        return true;
    }
}