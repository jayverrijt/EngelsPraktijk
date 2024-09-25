<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsedItemsController extends Controller
{
    //
    public function runtime () {
        $fetch = \DB::table('users')->where('id', \Auth::id())->first();
        $sysfetch = \DB::table('system')->where('foreign', \Auth::id())->first('country');
        $sysfetch = $sysfetch->country;
        $land = \DB::table('country')->where('id', $sysfetch)->first('name');
        $land = $land->name;
        $fetchu = $fetch->ucsetup;
        $provfetch = \DB::table('system')->where('foreign', \Auth::id())->first('province');
        $provfetch = $provfetch->province;
        $selables = \DB::table('sales')->whereNot('owner', \Auth::id())->where('province', $provfetch)->where('status', 1)->get();
        $myprov = \DB::table('system')->where('foreign', \Auth::id())->first('province');
        $myprov = $myprov->province;
        $allprov = \DB::table('province')->where('countryid', $sysfetch)->get();

        if ($fetchu == 0) {
            $provinces = \DB::table('province')->where('countryid', $sysfetch)->get();

            return view('application.uc-setup', compact('provinces', 'land'));
        } else if ($fetchu == 1) {
            //  Accepted
            return view('application.layouts.store.main', compact('selables', 'myprov', 'allprov'));
        }
    }

    public function setup() {
        $newprov = request('province');
        $listprov = request('provinces');
        $sysfetch = \DB::table('system')->where('foreign', \Auth::id())->first('country');
        $sysfetch = $sysfetch->country;
        $provfetch = \DB::table('system')->where('foreign', \Auth::id())->first('province');
        $provfetch = $provfetch->province;
        $selables = \DB::table('sales')->whereNot('owner', \Auth::id())->where('province', $provfetch)->where('status', 1)->get();
        $myprov = \DB::table('system')->where('foreign', \Auth::id())->first('province');
        $myprov = $myprov->province;
        $allprov = \DB::table('province')->where('countryid', $sysfetch)->get();
        if ($listprov != "nil") {
            \DB::table('system')->where('foreign', \Auth::id())->update([
                'province' => $listprov,
            ]);
            \DB::table('users')->where('id', \Auth::id())->update([
                'ucsetup' => 1,
            ]);
            return view('application.layouts.store.main', compact('selables', 'myprov', 'allprov'));
        }

        if ($listprov == "nil" AND $newprov != null) {
            $sysfetch = \DB::table('system')->where('foreign', \Auth::id())->first('country');
            $sysfetch = $sysfetch->country;
            $add = \DB::table('province')->insert([
                'name' => $newprov,
                'countryid' => $sysfetch,
                'status' => 1,
            ]);
            \DB::table('users')->where('id', \Auth::id())->update([
                'ucsetup' => 1,
            ]);
            return view('application.layouts.store.main', compact('selables', 'myprov', 'allprov'));
        }
    }

    public function switchProv () {
        $newprov = request('province');
        $myprov = $newprov;
        $sysfetch = \DB::table('system')->where('foreign', \Auth::id())->first('country');
        $sysfetch = $sysfetch->country;
        $allprov = \DB::table('province')->where('countryid', $sysfetch)->get();
        $selables = \DB::table('sales')->whereNot('owner', \Auth::id())->where('province', $myprov)->where('status', 1)->get();
        return view('application.layouts.store.main', compact('selables', 'myprov', 'allprov'));
    }

    public function purchase ()
    {
        $item = request('product');
        $fetch = \DB::table('sales')->where('id', $item)->first();
        $noti = \DB::table('notifications')->insert([
            'foreign' => $fetch->owner,
            'notification' => 'An product has been purchased!',
            'type' => 2,
            'action' => $item,
        ]);
        $update = \DB::table('sales')->where('id', $item)->update([
            'status' => 2,
        ]);
        $sold = \DB::table('sold')->insert([
            'foreign' => $fetch->owner,
            'buyer' => \Auth::id(),
            'product' => $fetch->foreign,
            'status' => 1,
        ]);
        return redirect()->route('uc.index');

    }
    public function purchaseSubmit ($id)
    {
        $item = \DB::table('notifications')->where('id', $id)->first('action');
        $item = $item->action;
        $fetch = \DB::table('sales')->where('id', $item)->first();
        $soldfetch = \DB::table('sold')->where('product', $fetch->foreign)->first();
        $clothes = \DB::table('clothes')->where('id', $fetch->foreign)->first();

        return view('application.layouts.store.overiew', compact('fetch', 'clothes', 'item', 'soldfetch', 'id'));
    }

    public function purchaseProcessor ($id) {
        $item = \DB::table('notifications')->where('id', $id)->first('action');
        $item = $item->action;
        $fetch = \DB::table('sales')->where('id', $item)->first();
        $soldfetch = \DB::table('sold')->where('product', $fetch->foreign)->first();
        $clothes = \DB::table('clothes')->where('id', $fetch->foreign)->first();
        $newowner = \DB::table('users')->where('id', $soldfetch->buyer)->select()->first();
        $newownerid = $newowner->id;
        $newownername = $newowner->name;
        $button = request('button');
        if ($button == 1) {
            $soldfetch = \DB::table('sold')->where('product', $fetch->foreign)->delete();
            $update = \DB::table('sales')->where('id', $item)->delete();
            $noti = \DB::table('notifications')->where('id', $id)->delete();
            $cltype = $clothes->type;
            $newsecid = null;
            $newid = \DB::table('sold')->where('product', $fetch->foreign)->first('buyer');
            $newid = $newid->buyer;
            if ($cltype == 1) {
                $newsecidfetch = \DB::table('clothes')->where('secid', $newid)->max('secid');
                $newsecidfetch = $newsecidfetch + 1;
                $clothes = \DB::table('clothes')->where('id', $fetch->foreign)->update([
                    'secid' => $newsecidfetch,
                    'foreign' => $newownerid,
                ]);
            } else if ($cltype == 2) {
                $newsecidfetch = \DB::table('clothes')->where('secid', $newid)->max('secid');
                $newsecidfetch = $newsecidfetch + 1;
                $clothes = \DB::table('clothes')->where('id', $fetch->foreign)->update([
                    'secid' => $newsecidfetch,
                    'foreign' => $newownerid,
                ]);
            } else if ($cltype == 3) {
                $newsecidfetch = \DB::table('clothes')->where('secid', $newid)->max('secid');
                $newsecidfetch = $newsecidfetch + 1;
                $clothes = \DB::table('clothes')->where('id', $fetch->foreign)->update([
                    'secid' => $newsecidfetch,
                    'foreign' => $newownerid,
                ]);
            } else if ($cltype == 4) {
                $newsecidfetch = \DB::table('clothes')->where('secid', $newid)->max('secid');
                $newsecidfetch = $newsecidfetch + 1;
                $clothes = \DB::table('clothes')->where('id', $fetch->foreign)->update([
                    'secid' => $newsecidfetch,
                    'foreign' => $newownerid,
                ]);
            }
        } else if ($button == 2) {
            $soldfetch = \DB::table('sold')->where('product', $fetch->foreign)->delete();
            $update = \DB::table('sales')->where('id', $item)->update([
                'status' => 1,
            ]);
            $noti = \DB::table('notifications')->where('id', $id)->delete();
            return redirect()->route('uc.index');
        } else {
            \Auth::logout();
            echo 'Womp Womp';
            echo '<br>';
            die('Invalid Action!, GoodLookz session ended!');
        }
    }
}
