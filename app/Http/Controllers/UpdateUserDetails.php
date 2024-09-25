<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateUserDetails extends Controller
{
    public function updateEmail($id) {
        $email = request('email');

        try {
            \DB::table('users')->where('id', $id)->update([
                'email' => $email
            ]);
            return redirect()->route('admin.dashboard-admins');

        } catch (Exception $e) {
            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }
    public function updateName($id) {
        $firstname = request('firstname');
        $lastname = request('lastname');
        $newname = $firstname . ' ' . $lastname;

        try {
            \DB::table('users')->where('id', $id)->update([
                'name' => $newname
            ]);
            return redirect()->route('admin.dashboard-admins');

        } catch (Exception $e) {
            return back()->with('error', 'An error occurred. Please try again later.');
        }
    }
}
