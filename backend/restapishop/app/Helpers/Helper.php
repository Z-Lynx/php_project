<?php
namespace App\Helpers;
use App\Events\PodcastProcessed;
use App\Models\Notifications;
use Google\Client as GoogleClient;

class FCMNotification{

    public function sendNotification($body, $user){
        $credentialsFilePath = public_path("key/key.json");
        $client = new GoogleClient();

        $client->setAuthConfig($credentialsFilePath);

        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $notification = Notifications::create([
            'user_id' => $user->id,
            'read_at' => null,
            'data' => $body,
            'type' => 'info',
        ]);

        broadcast(new PodcastProcessed($notification));

        if(!$user->get_fcm()){
            return false;
        }

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];

        $data = [
            "message" => [
                "token" => $user->get_fcm(),
                "notification" => [
                    "title" => "TTTN Shop Thông Báo",
                    "body" => $body,

                ],
                "apns" => [
                    "payload" => [
                        "aps" => [
                            "sound" => "default"
                        ]
                    ]
                ]
            ]
        ];
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/tttn-5d560/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return true;
    }
}
