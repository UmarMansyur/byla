<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read_notif(Request $request) {
        $notify = Notification::find($request->id);
        $notify->is_read = true;
        $notify->save();
        return response()->json(['success' => true]);
    }

    public function read_notif_admin(Request $request) {
        $notify = Notification::find($request->id);
        $notify->is_read = true;
        $notify->save();
        return response()->json(['success' => true]);
    }
}
