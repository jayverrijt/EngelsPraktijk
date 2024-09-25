<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationDaemonController extends Controller
{
    public function addNotification($id, $msg, $type) {
        $notification = new Notification();
        $notification->foreign = $id;
        $notification->notification = $msg;
        $notification->type = $type;
        $notification->save();
    }

    public function updateNotifySettings() {
        $user = Auth::id();

        if (request('friendRequests') == '0') {
            \DB::table('notification-settings')->where('foreign', $user)->update(['nfr' => 0]);
            return redirect()->back()->with('success', 'Settings updated');
        } else if(request('friendRequests') == '1') {
            \DB::table('notification-settings')->where('foreign', $user)->update(['nfr' => 1]);
            return redirect()->back()->with('success', 'Settings updated');
        } else if(request('borrowRequests') == '0') {
            \DB::table('notification-settings')->where('foreign', $user)->update(['nbr' => 0]);
            return redirect()->back()->with('success', 'Settings updated');
        } else if (request('borrowRequests') == '1') {
            \DB::table('notification-settings')->where('foreign', $user)->update(['nbr' => 1]);
            return redirect()->back()->with('success', 'Settings updated');
        } else if(request('saleRequests') == 0) {
            \DB::table('notification-settings')->where('foreign', $user)->update(['nsr' => 0]);
            return redirect()->back()->with('success', 'Settings updated');
        } else if (request('saleRequests') == 1) {
            \DB::table('notification-settings')->where('foreign', $user)->update(['nsr' => 1]);
            return redirect()->back()->with('success', 'Settings updated');
        } else {
            return redirect()->back()->with('error', 'An error occured');
        }




    }
}
