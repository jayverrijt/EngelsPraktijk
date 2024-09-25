<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WardrobeFriendsController extends Controller
{

     public function specificFriend() {
        $mode = 1;
        $id = request('id');
        // Name and Username
        $fetchName = \DB::table('users')->select('name')->where('id', $id)->first();
        $fetchUserName = \DB::table('system')->select('username')->where('foreign', $id)->first();
        $fetchName = $fetchName->name;
        $fetchUserName = $fetchUserName->username;
        $name = "".$fetchName." - (@".$fetchUserName.")";

        $head = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 1)->get();
        $top = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 2)->get();
        $pants = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 3)->get();
        $shoes = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 4)->get();
        return view('application.layouts.wardrobe.specificFriend', compact('head', 'top', 'pants', 'shoes', 'id', 'name', 'mode'));
    }

    public function mode()
    {
        $mode = request('menu');
        $id = request('id');
        if ($mode == 1) {
            $id = request('id');
            $fetchName = \DB::table('users')->select('name')->where('id', $id)->first();
            $fetchUserName = \DB::table('system')->select('username')->where('foreign', $id)->first();
            $fetchName = $fetchName->name;
            $fetchUserName = $fetchUserName->username;
            $name = "" . $fetchName . " - (@" . $fetchUserName . ")";

            $head = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 1)->get();
            $top = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 2)->get();
            $pants = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 3)->get();
            $mode = request('menu');
            $shoes = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 4)->get();
            return view('application.layouts.wardrobe.specificFriend', compact('head', 'top', 'pants', 'shoes', 'name', 'id', 'mode'));
        } else if ($mode == 2) {
            $id = request('id');
            $fetchName = \DB::table('users')->select('name')->where('id', $id)->first();
            $fetchUserName = \DB::table('system')->select('username')->where('foreign', $id)->first();
            $fetchName = $fetchName->name;
            $fetchUserName = $fetchUserName->username;
            $name = "" . $fetchName . " - (@" . $fetchUserName . ")";
            $head = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 1)->get();
            $top = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 2)->get();
            $pants = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 3)->get();
            $shoes = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 4)->get();
            $mode = request('menu');
            return view('application.layouts.wardrobe.specificFriend', compact('head', 'top', 'pants', 'shoes', 'name', 'id', 'mode'));
        } else if ($mode == 3) {
            $id = request('id');
            $fetchName = \DB::table('users')->select('name')->where('id', $id)->first();
            $fetchUserName = \DB::table('system')->select('username')->where('foreign', $id)->first();
            $fetchName = $fetchName->name;
            $fetchUserName = $fetchUserName->username;
            $name = "" . $fetchName . " - (@" . $fetchUserName . ")";
            $head = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 1)->get();
            $top = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 2)->get();
            $pants = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 3)->get();
            $shoes = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 4)->get();
            $mode = request('menu');
            return view('application.layouts.wardrobe.specificFriend', compact('head', 'top', 'pants', 'shoes', 'name', 'id', 'mode'));
        } else if ($mode == 4) {
            $id = request('id');
            $fetchName = \DB::table('users')->select('name')->where('id', $id)->first();
            $fetchUserName = \DB::table('system')->select('username')->where('foreign', $id)->first();
            $fetchName = $fetchName->name;
            $fetchUserName = $fetchUserName->username;
            $name = "" . $fetchName . " - (@" . $fetchUserName . ")";
            $head = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 1)->get();
            $top = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 2)->get();
            $pants = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 3)->get();
            $shoes = \DB::table('clothes')->select()->where('foreign', $id)->where('type', 4)->get();
            $mode = request('menu');
            return view('application.layouts.wardrobe.specificFriend', compact('head', 'top', 'pants', 'shoes', 'name', 'id', 'mode'));
        }
    }
    public function allFriends () {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }

        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();

        $match = array();

        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }

        // Fetching the IDs of the clothes

        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$counth] = $h->id;
                $counth++;
            }
        }
        $counthead = (int)1;
        $counttop = (int)1;
        $countpant = (int)1;
        $countshoe = (int)1;
        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));
    }

    public function headUp() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$counth] = $h->id;
                $counth++;
            }
        }
        $counthead = request('head');
        $counthead = $counthead + 1;
        $counttop = request('top');
        $countpant = request('pant');
        $countshoe = request('shoe');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));
    }
    public function headDown() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$friend][$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$counth] = $h->id;
                $counth++;
            }
        }
        $counthead = request('head');
        $counthead = $counthead - 1;
        $counttop = request('top');
        $countpant = request('pant');
        $countshoe = request('shoe');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));
    }
    public function topUp() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$counth] = $h->id;
                $counth++;
            }
        }
        $counttop = request('top');
        $counttop = $counttop + 1;
        echo $counttop;
        $counthead = request('head');
        $countpant = request('pant');
        $countshoe = request('shoe');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));
    }
    public function topDown() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$counth] = $h->id;
                $counth++;
            }
        }
        $counttop = request('top');
        $counttop = $counttop - 1;
        echo $counttop;
        $counthead = request('head');
        $countpant = request('pant');
        $countshoe = request('shoe');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;
        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));
    }
    public function pantUp() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$counth] = $h->id;
                $counth++;
            }
        }
        $countpant = request('pant');
        $countpant = $countpant + 1;
        $counthead = request('head');
        $counttop = request('top');
        $countshoe = request('shoe');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));

    }
    public function pantDown() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$friend][$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$friend][$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$friend][$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$friend][$counth] = $h->id;
                $counth++;
            }
        }
        $countpant = request('pant');
        $countpant = $countpant - 1;
        $counthead = request('head');
        $counttop = request('top');
        $countshoe = request('shoe');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));


    }
    public function shoeUp() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$friend][$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$friend][$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$friend][$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$friend][$counth] = $h->id;
                $counth++;
            }
        }
        $countshoe = request('shoe');
        $countshoe = $countshoe + 1;
        $counthead = request('head');
        $counttop = request('top');
        $countpant = request('pant');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));

    }
    public function shoeDown() {
        $me = \Auth::id();
        $friends1 = \DB::table('friends')->select('user2')->where('user1', $me)->get();
        $friends2 = \DB::table('friends')->select('user1')->where('user2', $me)->get();
        $friends = array();
        foreach ($friends1 as $f1) {
            $friends[] = $f1->user2;
        }
        foreach ($friends2 as $f2) {
            $friends[] = $f2->user1;
        }
        // See what sizes match
        $mysize = \DB::table('size-manager')->select()->where('foreign', \Auth::id())->first();
        $counth = (int)1;
        $countt = (int)1;
        $countp = (int)1;
        $counts = (int)1;
        $match = array();
        foreach ($friends as $friend) {
            $friendSize = \DB::table('size-manager')->select()->where('foreign', $friend)->first();
            if ($mysize->top == $friendSize->top) {
                $match['tops'][] = $friend;
            }
            if ($mysize->pants == $friendSize->pants) {
                $match['pants'][] = $friend;
            }
            if ($mysize->shoes == $friendSize->shoes) {
                $match['shoes'][] = $friend;
            }
        }
        $tops = array();
        $pants = array();
        $shoes = array();
        $heads = array();
        foreach ($friends as $friend) {
            $top = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 2)->get();
            foreach ($top as $t) {
                $tops[$friend][$countt][] = $t->id;
                $countt++;
            }
            $pant = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 3)->get();
            foreach ($pant as $p) {
                $pants[$friend][$countp] = $p->id;
                $countp++;
            }
            $shoe = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 4)->get();
            foreach ($shoe as $s) {
                $shoes[$friend][$counts] = $s->id;
                $counts++;
            }
            $head = \DB::table('clothes')->select()->where('foreign', $friend)->where('type', 1)->get();
            foreach ($head as $h) {
                $heads[$friend][$counth] = $h->id;
                $counth++;
            }
        }
        $countshoe = request('shoe');
        $countshoe = $countshoe - 1;
        $counthead = request('head');
        $counttop = request('top');
        $countpant = request('pant');
        $counthead = (int)$counthead;
        $countpant = (int)$countpant;
        $countshoe = (int)$countshoe;

        return view('application.layouts.wardrobe.all', compact('friends', 'tops', 'pants', 'shoes', 'heads', 'match', 'counthead', 'counttop', 'countpant', 'countshoe'));

    }
}
