<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InYourColourController extends Controller
{
    public function add() {
        \DB::table('inyourcolour')->insert([
            'name' => request('colourName'),
            'hex' => request('colourCode'),
        ]);
        return redirect()->back();
    }
}
