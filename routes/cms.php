<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UpdateUserDetails;
    use App\Http\Controllers\addUserController;
    use App\Http\Controllers\editUserController;
    use App\Http\Controllers\AdminDBController;
    use App\Http\Controllers\CardController;

    Route::middleware('auth')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.layouts.launch');
        })->middleware(['auth', 'verified'])->name('admin.dashboard');
        Route::get('/admin/cards', function () {
            $qs = \DB::table('questions')->select()->get();
            $ov = \DB::table('questions')->select()->max('id');
            $jnv = \DB::table('questionsyn')->select()->max('id');
            $qsyn = \DB::table('questionsyn')->select()->get();
            $levels = \DB::table('levels')->select('id', 'level_name')->get();
            return view('admin.layouts.cards', compact('qs', 'qsyn', 'ov', 'jnv', 'levels'));
        })->middleware(['auth', 'verified'])->name('admin.cards');
        Route::get('/admin/cards/fs', function () {
            $type = request('type');
            if ($type == 1) {
                $data = \DB::table('questions')->select()->get();
            } elseif ($type == 2) {
                $data = \DB::table('questionsyn')->select()->get();
            }
            return view('admin.layouts.cards-fs', compact('type', 'data'));
        })->middleware(['auth', 'verified'])->name('admin.cards-fs');
        Route::get('/admin/cards/add', [CardController::class, 'add'])->name('admin.cards-add');
        Route::get('/admin/dashboard/db', function () {
            return view('admin.layouts.db');
        })->middleware(['auth', 'verified'])->name('admin.dashboard-db');
        Route::get('/admin/dashboard/users', function () {
            $users = DB::table('users')->select('id','name', 'email', 'class_id', 'type')->get();
            return view('admin.layouts.users', compact('users'));
        })->middleware(['auth', 'verified'])->name('admin.dashboard-users');
        Route::get('/admin/dashboard/admins', function () {
            $users = DB::table('users')->select('id','name', 'email', 'type')->get();
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
        Route::get('/admin/dashboard/db/view', [AdminDBController::class, 'redirect'])->name('admin.dashboard-db-view');
        Route::get('/admin/dashboard/db/view/del/{id}', [AdminDBController::class, 'delete'])->name('admin.dashboard-db-view.delete');
    });
