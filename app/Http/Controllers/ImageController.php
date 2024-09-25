<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    // View File To Upload Image
    public function index()
    {
        return redirect()->back();
    }

    // Store Image
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        // Public Folder
        $request->image->move(public_path('upload/4store'), $imageName);

        //Store in DB
        $name = $request->name;
        $type = $request->type;
        $url = $request->url;
        $country = $request->country;
        $type = $request->type;
        $continents = \DB::table('country')->select('continent_id')->where('id', $country)->get();
        foreach ($continents as $continent) {
            $continent = $continent->continent_id;
        }
        \DB::table('shops')->insert([
            'name' => $name,
            'type' => $type,
            'url' => $url,
            'continent' => $continent,
            'picture' => $imageName
        ]);

        return redirect()->route('admin.dashboard-shops');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        // Public Folder
        $request->image->move(public_path('upload/4store'), $imageName);

        //Store in DB
        $name = $request->name;
        $type = $request->type;
        $url = $request->url;
        $country = $request->country;
        $type = $request->type;
        $id = $request->id;
        $continents = \DB::table('country')->select('continent_id')->where('id', $country)->get();
        foreach ($continents as $continent) {
            $continent = $continent->continent_id;
        }
        \DB::table('shops')->where('id', $id)->update([
            'name' => $name,
            'type' => $type,
            'url' => $url,
            'continent' => $continent,
            'picture' => $imageName,
        ]);
        return redirect()->route('admin.dashboard-shops');


    }

    public function updatePfp(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        // Public Folder
        $request->image->move(public_path('upload/profile'), $imageName);

        \DB::table('system')->where('foreign', Auth::id())->update([
            'picture' => $imageName
        ]);
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        // Public Folder
        $request->image->move(public_path('upload/product'), $imageName);

        // Fill DB
        $name = $request->name;
        $uid = $request->uid;
        $foreign = \Auth::id();
        $type = $request->type;
        $color = $request->color;
        $size = null;

        $preFetch = \DB::table('clothes')->where('foreign', $foreign)->where('type', $type)->max('secid');
        $newSecid = $preFetch + 1;
        var_dump($newSecid);
        var_dump($type);
        if ($type == 1) {
            $size = $request->head;
            \DB::table('clothes')->insert([
                'foreign' => $foreign,
                'secid' => $newSecid,
                'name' => $name,
                'type' => $type,
                'size' => $size,
                'color' => $color,
                'picture' => $imageName
            ]);
        } else if ($type == 2) {
            $size = $request->top;
            \DB::table('clothes')->insert([
                'foreign' => $foreign,
                'secid' => $newSecid,
                'name' => $name,
                'type' => $type,
                'size' => $size,
                'color' => $color,
                'picture' => $imageName
            ]);
        } else if ($type == 3) {
            $size = $request->pants;
            \DB::table('clothes')->insert([
                'foreign' => $foreign,
                'secid' => $newSecid,
                'name' => $name,
                'type' => $type,
                'size' => $size,
                'color' => $color,
                'picture' => $imageName
            ]);
        } else if ($type == 4) {
            $size = $request->shoes;
            \DB::table('clothes')->insert([
                'foreign' => $foreign,
                'secid' => $newSecid,
                'name' => $name,
                'type' => $type,
                'size' => $size,
                'color' => $color,
                'picture' => $imageName
            ]);
        }
        return redirect()->route('application.wardrobe');
    }
}
