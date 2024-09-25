<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class filterWardrobeController extends Controller
{
    public function type ($color) {
        $colors = \DB::table('colors')->get();
        return view('application.layouts.wardrobe.filter-type', compact('color', 'colors'));
    }
    public function runtime($color, $type) {
        $selcolor = request('color');
        $colors = \DB::table('colors')->get();
        $type = request('type');

        // Contructor
        $clothes = \DB::table('clothes')
            ->where('color', $selcolor)
            ->where('type', $type)
            ->where('foreign', \Auth::id())
            ->get();
        if ($clothes->isEmpty()) {
            $item = null;
            return view('application.layouts.wardrobe.filter-view', compact( 'item', 'color', 'type', 'colors', 'selcolor'));
        } else if ($clothes->isNotEmpty()) {
            if ($type == 1) {
                $item = \DB::table('clothes')
                    ->where('color', $selcolor)
                    ->where('type', $type)
                    ->where('foreign', \Auth::id())
                    ->where('type', '1')
                    ->get();
                if ($item->isEmpty()) {
                    $item = null;
                } else if ($item->isNotEmpty()) {
                    $item = $item->first();
                }
            } else if ($type == 2) {
                $item = \DB::table('clothes')
                    ->where('color', $selcolor)
                    ->where('type', $type)
                    ->where('foreign', \Auth::id())
                    ->where('type', '2')
                    ->get();
                if ($item->isEmpty()) {
                    $item = null;
                } else if ($item->isNotEmpty()) {
                    $item = $item->first();
                }
            } else if ($type == 3) {
                $item = \DB::table('clothes')
                    ->where('color', $selcolor)
                    ->where('type', $type)
                    ->where('foreign', \Auth::id())
                    ->where('type', '3')
                    ->get();
                if ($item->isEmpty()) {
                    $item = null;
                } else if ($item->isNotEmpty()) {
                    $item = $item->first();
                }
            } else if ($type == 4) {
                $item = \DB::table('clothes')
                    ->where('color', $selcolor)
                    ->where('type', $type)
                    ->where('foreign', \Auth::id())
                    ->where('type', '4')
                    ->get();
                if ($item->isEmpty()) {
                    $item = null;
                } else if ($item->isNotEmpty()) {
                    $item = $item->first();
                }
            }
            return view('application.layouts.wardrobe.filter-view', compact('item', 'color', 'type', 'colors', 'selcolor'));
        }
    }
    public function headUp($color) {
        $colors = \DB::table('colors')->get();
        $selcolor = request('color');
        $type = request('type');
        $prevSecid = request('item');
        $newSecid = (int)$prevSecid+ 1;
        $item = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', $type)->where('secid', $newSecid)->where('color', $selcolor)->select('secid')->first();
        return view('application.layouts.wardrobe.filter-view', compact('item', 'colors', 'color', 'type', 'selcolor'));

    }
    public function headDown($color) {
        $colors = \DB::table('colors')->get();
        $selcolor = request('color');
        $type = request('type');
        $prevSecid = request('item');
        $newSecid = (int)$prevSecid- 1;
        $item = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', $type)->where('secid', $newSecid)->where('color', $selcolor)->select('secid')->first();
        return view('application.layouts.wardrobe.filter-view', compact('item', 'colors', 'color', 'type', 'selcolor'));

    }

}
