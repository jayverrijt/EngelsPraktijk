<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class accountSetupController extends Controller
{
    public function runtime () {
        $id = Auth::id();
        if (\DB::table('users')->where('id', $id)->exists()) {
            $user = \DB::table('users')->where('id', $id)->first();
            if ($user->setup == '0') {
                return redirect()->route('application.setup');
            } else if ($user->setup == '1') {
                return redirect()->route('admin.dashboard');
            } else if($user->setup == '2') {
                return redirect()->route('admin.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'You are not logged in');
        }
    }
    public function setup () {
        $country = request('country');
        if ($country != null) {
            $continent = \DB::table('country')->select('continent_id')->where('id', $country)->get();
            $continent = $continent[0]->continent_id;
        }
        try
        {
            $id = Auth::id();
            $users = \DB::table('users')->select('setup')->where('id' , $id)->get();
            foreach($users as $user) {
                \DB::table('pref-shops')->insert([
                    'foreign' => $id,
                ]);
                \DB::table('notification-settings')->insert([
                    'foreign' => $id,
                    'nfr' => '1',
                    'nbr' => '1',
                    'nsr' => '1',
                ]);
                if ($user->setup == '0') {
                    $takenusernames = \DB::table('system')->select('username')->get();
                    foreach ($takenusernames as $takenusername)
                    {
                        \DB::table('users')->where('id', $id)->update([
                            'setup' => '1',
                        ]);
                        if ($takenusername->username == request('username')) {
                            return redirect()->route('application.setup')->with('error', 'Username already taken');
                        } else if ($takenusername->username != request('username')) {
                            \DB::table('system')->insert([
                                'foreign' => $id,
                                'username' => request('username'),
                                'phone' => request('phone'),
                                'gender' => request('gender'),
                                'country' => request('country'),
                                'city' => request('city'),
                                'picture' => 'default.jpg',
                                'about' => 'Default about message from GoodLookz',
                                'birthday' => request('birthday'),
                                'continent' => $continent,
                            ]);
                            return redirect()->route('account.setup');
                        } else {
                            return redirect()->route('account.setup');
                        }
                    }
                } else if ($user->setup == '1') {
                    return redirect()->route('application.dashboard');
                }
            }

        } catch (Exception $ex) {
            return redirect()->route('application.setup')->with('error', 'An error occured '.$ex->getMessage(). '!');
        }
    }

    public function setupWardrobe () {
        try
        {
            $id = Auth::id();
            // Obsolete
            //\DB::table('size-manager')->insert([
            //    'foreign' => $id,
            //    'top' => request('top'),
            //    'pants' => request('pants'),
            //    'shoes' => request('shoes'),
            //]);
            $top = request('top');
            $pants = request('pants');
            $shoes = request('shoes');
            $topfetch = \DB::table('sizes')->where('type', 0)->where('size', $top)->select('id')->first('id');
            $pantsfetch = \DB::table('sizes')->where('type', 1)->where('size', $pants)->first('id');
            $shoesfetch = \DB::table('sizes')->where('type', 2)->where('size', $shoes)->first('id');
            foreach ($topfetch as $top)
            {
                $top = $top;
            }
            foreach ($pantsfetch as $pants)
            {
                $pants = $pants;
            }
            foreach ($shoesfetch as $shoes)
            {
                $shoes = $shoes;
            }
            \DB::table('size-manager')->insert([
                'foreign' => $id,
                'top' => $top,
                'pants' => $pants,
                'shoes' => $shoes,
            ]);
            \DB::table('users')->where('id', $id)->update([
                'setup' => '2',
            ]);
            return redirect()->route('application.dashboard');
        } catch (Exception $ex) {
            return redirect()->route('application.setup')->with('error', 'An error occured '.$ex->getMessage(). '!');
        }
    }
}
