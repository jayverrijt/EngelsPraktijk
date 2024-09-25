<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Exception;

class UpdatePasswdController extends Controller
{
    public function updateAdmins($id) {
        $oldPassword = request('old-password');
        $newPassword = request('new-password');
        $confirmPass = request('confirm-new-pass');

        $errormsg = "Error";
        if ($newPassword != $confirmPass) {
            $errormsg = "Password not match";
            return redirect()->back()->with($errormsg);
        } else {
            $oldhash = \DB::table('users')->select('password')->where('id', $id)->get();
            foreach ($oldhash as $oldhash) {
                $oldhash = $oldhash->password;
                if (\Hash::check($oldPassword, $oldhash)) {
                    try {
                        \DB::table('users')->where('id', $id)->update(['password' => \Hash::make($newPassword)]);
                        return redirect()->route('admin.dashboard-admins');
                    } catch (Exception $ex) {
                        echo $ex;
                    }
                } else {
                    $errormsg = "Old password is incorrect";
                    return redirect()->back()->with('error', $errormsg);
                }
            }


        }


    }
}
