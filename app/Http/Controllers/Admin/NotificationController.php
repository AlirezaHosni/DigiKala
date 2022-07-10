<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use function now;

class NotificationController extends Controller
{
    public function readAll(){
        $unreadNotifications = Notification::where('read_at', null)->get();
        foreach ($unreadNotifications as $unreadNotification){
            $unreadNotification->read_at = now();
            $unreadNotification->save();
        }
    }
}
