<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class editUserController extends Controller
{
    //
    public function update ($id) {
        $firstname = request('firstname');
        $lastname = request('lastname');
        $username = request('username');
        $email = request('email');
        $password = request('password');
        $dob = request('dob');
        $name = $firstname . ' ' . $lastname;
        $country = request('country');
        if ($country != null) {
         $continent = \DB::table('country')->select('continent_id')->where('id', $country)->get();
         $continent = $continent[0]->continent_id;
        }


        \DB::table('users')->where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
          //  'dob' => $dob
        ]);
        if(\DB::table('system')->where('foreign', $id)->exists()) {
            \DB::table('system')->where('foreign', $id)->update([
                'username' => $username,
                'phone' => request('phone'),
                'city' => request('city'),
                'country' => request('country'),
                'continent' => $continent,
                'gender' => request('gender'),
            ]);
        } else {
            \DB::table('system')->insert([
                'foreign' => $id,
                'username' => $username,
                'phone' => request('phone'),
                'city' => request('city'),
                'country' => request('country'),
                'continent' => $continent,
                'gender' => request('gender'),
            ]);
        }
       return redirect()->route('admin.dashboard-users');
    }
}
