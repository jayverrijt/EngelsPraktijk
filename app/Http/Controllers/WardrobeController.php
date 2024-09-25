<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class WardrobeController extends Controller
{

    public function __construct()
    {
        $clothes = \DB::table('clothes')->where('foreign', \Auth::id())->get();
        if ($clothes->isEmpty()) {
            // No Clothes for user
            $head = null;
            $top = null;
            $pants = null;
            $shoes = null;
            return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));

        } else if ($clothes->isNotEmpty()) {
            // Head
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->get();
            if ($head->isEmpty()) {
                // No Head
                $head = null;

            } else if ($head->isNotEmpty()) {
                // Fetch First head
                $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->first('secid');
            }
            // Top
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->get();
            if ($top->isEmpty()) {
                // No Top
                $top = null;
            } else if ($top->isNotEmpty()) {
                // Fetch First Top
                $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->first('secid');
            }
            // Pants
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->get();
            if ($pants->isEmpty()) {
                // No Pants
                $pants = null;
            } else if ($pants->isNotEmpty()) {
                // Fetch First Pants
                $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->first('secid');
            }
            // Shoes
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->get();
            if ($shoes->isEmpty()) {
                // No Shoes
                $shoes = null;
            } else if ($shoes->isNotEmpty()) {
                // Fetch First Shoes
                $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->first('secid');
            }
            return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
        }


    }
    public function headUp () {
        $prevSecid = request('head');
        $newSecid = (int)$prevSecid+ 1;
        $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '1')->where('secid', $newSecid)->get();
        $top = request('top');
        $pants = request('pants');
        $shoes = request('shoes');
        if ($top == null) {
            $top = 1;
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        } else {
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        }
        if ($pants == null) {
            $pants = 1;
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        } else {
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        }
        if ($shoes == null) {
            $shoes = 1;
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        }
        $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function headDown()
    {
        $prevSecid = request('head');
        $newSecid = (int)$prevSecid- 1;
        $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '1')->where('secid', $newSecid)->get();
        $top = request('top');
        $pants = request('pants');
        $shoes = request('shoes');
        if ($top == null) {
            $top = 1;
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        } else {
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        }
        if ($pants == null) {
            $pants = 1;
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        } else {
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        }
        if ($shoes == null) {
            $shoes = 1;
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        }
        $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function topUp () {
        $prevSecid = request('top');
        $newSecid = (int)$prevSecid+ 1;
        $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '2')->where('secid', $newSecid)->get();
        $head = request('head');
        $pants = request('pants');
        $shoes = request('shoes');
        if ($head == null) {
            $head = 1;
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        } else {
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        }
        if ($pants == null) {
            $pants = 1;
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        } else {
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        }
        if ($shoes == null) {
            $shoes = 1;
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        }
        $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function topDown()
    {
        $prevSecid = request('top');
        $newSecid = (int)$prevSecid- 1;
        $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '2')->where('secid', $newSecid)->get();
        $head = request('head');
        $pants = request('pants');
        $shoes = request('shoes');
        if ($head == null) {
            $head = 1;
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        } else {
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        }
        if ($pants == null) {
            $pants = 1;
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        } else {
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        }
        if ($shoes == null) {
            $shoes = 1;
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        }
        $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function pantUp () {
        $prevSecid = request('pants');
        $newSecid = (int)$prevSecid+ 1;
        $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '3')->where('secid', $newSecid)->get();
        $head = request('head');
        $top = request('top');
        $shoes = request('shoes');
        if ($head == null) {
            $head = 1;
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        } else {
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        }
        if ($top == null) {
            $top = 1;
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        } else {
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        }
        if ($shoes == null) {
            $shoes = 1;
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        }
        $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }

    public function pantDown () {
        $prevSecid = request('pants');
        $newSecid = (int)$prevSecid- 1;
        $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '3')->where('secid', $newSecid)->get();
        $head = request('head');
        $top = request('top');
        $shoes = request('shoes');
        if ($head == null) {
            $head = 1;
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        } else {
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        }
        if ($top == null) {
            $top = 1;
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        } else {
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        }
        if ($shoes == null) {
            $shoes = 1;
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $shoes)->select('secid')->first();
        }
        $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function shoeUp() {
        $prevSecid = request('shoes');
        $newSecid = (int)$prevSecid+ 1;
        $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '4')->where('secid', $newSecid)->get();
        $head = request('head');
        $top = request('top');
        $pants = request('pants');
        if ($head == null) {
            $head = 1;
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        } else {
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        }
        if ($top == null) {
            $top = 1;
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        } else {
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        }
        if ($pants == null) {
            $pants = 1;
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        }
        $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function shoeDown() {
        $prevSecid = request('shoes');
        $newSecid = (int)$prevSecid- 1;
        $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', '4')->where('secid', $newSecid)->get();
        $head = request('head');
        $top = request('top');
        $pants = request('pants');
        if ($head == null) {
            $head = 1;
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        } else {
            $head = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 1)->where('secid', $head)->select('secid')->first();
            var_dump($head);
        }
        if ($top == null) {
            $top = 1;
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        } else {
            $top = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 2)->where('secid', $top)->select('secid')->first();
        }
        if ($pants == null) {
            $pants = 1;
            $pants = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        } else {
            $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 3)->where('secid', $pants)->select('secid')->first();
        }
        $shoes = \DB::table('clothes')->where('foreign', \Auth::id())->where('type', 4)->where('secid', $newSecid)->select('secid')->first();
        return view('application.layouts.wardrobe.main', compact('head', 'top', 'pants', 'shoes'));
    }
    public function updateBorrow($product) {
        $type = request('type');
        if ($type == 2) { // Extention on lend
            $borrows = \DB::table('borrowlist')->where('id', $product)->select()->get();
            $idf = $borrows[0]->product;
            $products = \DB::table('clothes')->where('id', $idf)->select()->get();
            return view('application.layouts.wardrobe.lending-extension', compact('products', 'borrows'));
        } else if ($type == 1 ) { // Bring back now
            \DB::table('borrowlist')->where('id', $product)->delete();
            $borrows = \DB::table('borrowlist')->where('lender', \Auth::id())->select()->get();
            $users = \DB::table('users')->select()->get();
            return view('application.layouts.wardrobe.lending-list', compact('users', 'borrows'));
        }
    }
    public function sellItem($id) {
        $clFetch = \DB::table('clothes')->where('id', $id)->select()->first();
        $sysFetch = \DB::table('system')->where('foreign', \Auth::id())->select()->first();
        $price = request('price');
        $desc = request('desciption');
        \DB::table('sales')->insert([
            'foreign' => $id,
            'name' => $clFetch->name,
            'description' => $desc,
            'type' => $clFetch->type,
            'size' => $clFetch->size,
            'picture' => $clFetch->picture,
            'owner' => \Auth::id(),
            'price' => $price,
            'province' => $sysFetch->province,
            'status' => 1,
        ]);
        return redirect()->route('application.wardrobe');
    }

    public function saveSet () {
        $name = request('name');
        $desc = request('description');
        $head = request('head');
        $top = request('top');
        $pant = request('pant');
        $shoe = request('shoe');

        if ($head == 0) {
            $head = null;
        }
        if ($top == 0) {
            $top = null;
        }
        if ($pant == 0) {
            $pant = null;
        }
        if ($shoe == 0) {
            $shoe = null;
        }

        $run = \DB::table('sets')->insert([
            'foreign' => \Auth::id(),
            'name' => $name,
            'description' => $desc,
            'accessories' => $head,
            'top' => $top,
            'pants' => $pant,
            'shoes' => $shoe,
        ]);
        return redirect()->route('application.wardrobe');
    }
}
