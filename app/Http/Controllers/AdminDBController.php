<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDBController extends Controller
{
    public function redirect() {
        $val = request('action');
        return view('admin.layouts.db.'.$val.'')->with('val', $val);

    }

    public function delete($id) {
        $table = request('table');
        $del = \DB::table($table)->where('id', $id)->delete();
        return redirect()->back();

    }
}
