<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readNotification(Request $request) {
        $user = User::find($request->userId);
        $notification = $user->notifications->find($request->notificationId);

        if($notification->read_at == null)
            $notification->markAsRead();

        if($user->hasRole('admin')){
            return redirect('/admin/all-tasks');
        }
        else{
            return redirect('/users/'.$user->name.'/my-tasks');
        }
    }

    public function readAllNotifications(Request $request) {
        $user = User::find($request->userId);
        if($user->unreadNotifications){
            $user->unreadNotifications->markAsRead();
        }

        return back()->with('message', "All notifications have been marked as read.");
    }
}
