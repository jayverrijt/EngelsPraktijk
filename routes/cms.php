<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UpdatePasswdController;
    use App\Http\Controllers\UnSocialController;
    use App\Http\Controllers\UpdateUserDetails;
    use App\Http\Controllers\addUserController;
    use App\Http\Controllers\editUserController;
    use App\Http\Controllers\InYourColourController;
    use App\Http\Controllers\ImageController;
    use App\Http\Controllers\AdminDBController;

    Route::middleware('auth')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.layouts.launch');
        })->middleware(['auth', 'verified'])->name('admin.dashboard');
        Route::get('/admin/dashboard/db', function () {
            return view('admin.layouts.db');
        })->middleware(['auth', 'verified'])->name('admin.dashboard-db');
        Route::get('/admin/dashboard/users', function () {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.users', compact('users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-users');
        Route::get('/admin/dashboard/inyourecolour', function () {
            $colors = \DB::table('inyourcolour')->select()->get();
            return view('admin.layouts.inyourecolour', compact('colors'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-inyourecolour');
        Route::get('/admin/dashboard/inyourecolour/add/', [InYourColourController::class, 'add'])->name('admin.dashboard-inyourecolour-add');
        Route::get('/admin/dashboard/inyourecolour/edit/{id}/', function () {
            $colors = \DB::table('inyourcolour')->select()->get();
            return view('admin.layouts.inyourecolour-edit', compact('colors'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-inyourecolour-edit');
        Route::get('/admin/dashboard/inyourecolour/delete/{id}/', function ($id) {
            DB::table('inyourcolour')->where('id', $id)->delete();
            return redirect()->route('admin.dashboard-inyourecolour');
        })->name('admin.dashboard-inyourecolour-delete');

        Route::get('/admin/dashboard/admins', function () {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.admins', compact('users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins');
        Route::get('/admin/dashboard/admins/delete/{id}', function ($id) {
            DB::table('users')->where('id', $id)->delete();
            return redirect()->route('admin.dashboard-admins');
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins-delete');
        Route::get('/admin/dashboard/admins/change/password/{id}', function ($id) {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.admins-change-password', compact('id', 'users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins-change-password');
        Route::get('/admin/dashboard/admins/change/unsocial/{id}', function ($id) {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.admins-unsocial', compact('id', 'users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins-change-unsocial');
        Route::get('/admin/dashboard/admins/change/email/{id}', function ($id) {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.admins-change-email', compact('id', 'users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins-change-email');
        Route::get('/admin/dashboard/admins/change/name/{id}', function ($id) {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.admins-change-name', compact('id', 'users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins-change-name');
        Route::get('/admin/dashboard/admins/add',  function () {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            return view('admin.layouts.admins-add', compact('users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-admins-add');
        Route::get('/admin/dashboard/users/delete/{id}', function ($id) {
            DB::table('users')->where('id', $id)->delete();
            return redirect()->route('admin.dashboard-users');
        })->middleware(['auth', 'verified'])->name('admin.dashboard-users-delete');
        Route::get('/admin/dashboard/admins/change/password/{id}/update', [UpdatePasswdController::class, 'updateAdmins'])->name('admin.dashboard-admins-change-password-update');
        Route::get('/admin/dashboard/admins/change/unsocial/{id}/update', [UnSocialController::class, 'runtime'])->name('admin.dashboard-admins-change-unsocial-update');
        Route::get('/admin/dashboard/admins/change/general/email/{id}/update', [UpdateUserDetails::class, 'updateEmail'])->name('admin.dashboard-admins-change-general-email-update');
        Route::get('/admin/dashboard/admins/change/general/name/{id}/update', [UpdateUserDetails::class, 'updateName'])->name('admin.dashboard-admins-change-general-name-update');
        Route::get('/admin/dashboard/admins/change/elevate/{id}', function() {
            $id = request('id');
            DB::table('users')->where('id', $id)->update(['type' => '2']);
            return redirect()->route('admin.dashboard-admins');
        })->name('admin.dashboard-admins-change-elevate');
        Route::get('/admin/dashboard/admins/change/de-elevate/{id}', function() {
            $id = request('id');
            DB::table('users')->where('id', $id)->update(['type' => '1']);
            return redirect()->route('admin.dashboard-admins');
        })->name('admin.dashboard-admins-change-de-elevate');
        Route::get('/admin/dashboard/adduser', [addUserController::class, 'runtime'])->name('admin.dashboard-adduser');
        Route::get('/admin/dashboard/users/edit/{id}', function ($id) {
            $users = DB::table('users')->select('id','name', 'email', 'google_id', 'acctype', 'type')->get();
            $countrys = DB::table('country')->select()->get();
            $continents = DB::table('continent')->select()->get();
            return view('admin.layouts.users-edit', compact('id', 'users', 'countrys', 'continents'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-users-edit');
        Route::get('/admin/dashboard/users/edit/{id}/update', [editUserController::class, 'update'])->name('admin.dashboard-users-edit-update');
        Route::get('/admin/dashboard/shops/add', function () {
            $countrys = DB::table('country')->select()->get();
            return view('admin.layouts.shops-add', compact('countrys'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-shops-add');
        Route::controller(ImageController::class)->group(function(){
            Route::get('/image-upload', 'index')->name('image.form');
            Route::post('/upload-image', 'storeImage')->name('image.store');
            Route::post('/update-image', 'updateImage')->name('image.update');
        });
        Route::get('/admin/dashboard/shops/del/{id}', function ($id) {
            DB::table('shops')->where('id', $id)->delete();
            return redirect()->route('admin.dashboard-shops');
        })->middleware(['auth', 'verified'])->name('admin.dashboard-shops-del');
        Route::get('/admin/dashboard/shops/edit/{id}', function ($id) {
            $countrys = DB::table('country')->select()->get();
            $shops = DB::table('shops')->select()->where('id', $id)->get();
            return view('admin.layouts.shops-update', compact('id', 'shops', 'countrys'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-shops-edit');
        Route::get('/admin/dashboard/db/view', [AdminDBController::class, 'redirect'])->name('admin.dashboard-db-view');
        Route::get('/admin/dashboard/db/view/del/{id}', [AdminDBController::class, 'delete'])->name('admin.dashboard-db-view.delete');
    });
