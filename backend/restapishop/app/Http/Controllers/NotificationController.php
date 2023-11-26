<?php

namespace App\Http\Controllers;

use App\Events\PodcastProcessed;
use App\Http\Resources\NotificationResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Helpers\FCMNotification;
use App\Models\User;

class NotificationController extends Controller
{
    use HttpResponses;

    public function getNotifications()
    {
        $notifications = Notifications::where('user_id', auth()->user()->id)->get();
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

    public function setToken(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $user->update([
            'fcm_id' => $request->fcm_id
        ]);

        return $this->successResponse('', 'set token successfully');
    }

    public function sendNotifications(Request $request)
    {
        $user = User::find($request->user_id);
        
        if($user->get_fcm()  != null) {
            $fcmNotification = new FCMNotification();
            $status = $fcmNotification->sendNotification($request->data, $user->get_fcm());
        }
        
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
