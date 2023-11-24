<?php

namespace App\Http\Controllers;

use App\Events\PodcastProcessed;
use App\Http\Resources\NotificationResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Notifications;

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
