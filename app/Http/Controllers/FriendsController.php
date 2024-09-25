<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function search()
    {
        try {
            $search = $_GET['friendName'];
            try {
                $users = \DB::table('system')->where('username', 'LIKE', '%' . $search . '%')->get();
                return view('application.layouts.friends-result', compact('users' ));
            } catch (\Throwable $tb) {
                echo $tb->getMessage();
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function decide ($id) {
        $choise = request('choise');

        try {
            if ($choise == '1') {
                \DB::table('friendrequest')->where('receiver', \Auth::id())->where('sender', $id)->update([
                    'status' => '2'
                ]);
                \DB::table('friends')->insert([
                    'user1' => $id,
                    'user2' => \Auth::id(),
                ]);
                return redirect()->back();
            } else {
                \DB::table('friendrequest')->where('receiver', \Auth::id())->where('sender', $id)->delete();
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deletePending () {
        try {
            $friend = request('friend');
            var_dump($friend);
            \DB::table('friendrequest')->where('receiver', $friend)->where('sender', \Auth::user()->id)->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            echo $th->getMessage();

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

    }

    public function deleteFriendA () {
        try {
            $friend = request('friend');
            \DB::table('friendrequest')->where('receiver', \Auth::user()->id)->where('sender', $friend)->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            echo $th->getMessage();

        }
    }
    public function deleteFriendB () {
        try {
            $friend = request('friend');
            \DB::table('friendrequest')->where('sender', \Auth::user()->id)->where('receiver', $friend)->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            echo $th->getMessage();

        }
    }

    public function addFriend() {
        try {
            $friend = request('friend');
            \DB::table('friendrequest')->insert([
                'sender' => \Auth::user()->id,
                'receiver' => $friend,
                'status' => '1'
            ]);
            \DB::table('notifications')->insert([
                'foreign' => $friend,
                'notification' => 'From' . \Auth::user()->name,
                'type' => '1'
            ]);

            return redirect()->back();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

    }


}
