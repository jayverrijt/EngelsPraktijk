<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\accountSetupController;
    use App\Http\Controllers\SettingsGroupController;
    use App\Http\Controllers\InYourColourController;
    use App\Http\Controllers\filterWardrobeController;
    use App\Http\Controllers\ImageController;
    use App\Http\Controllers\FriendsController;
    use App\Http\Controllers\NotificationDaemonController;
    use App\Http\Controllers\WardrobeController;
    use App\Http\Controllers\WardrobeFriendsController;

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [accountSetupController::class, 'runtime'])->name('account.setup');

        Route::get('/register/setup', function () {
            $countrys = DB::table('country')->select()->get();
            $continents = DB::table('continent')->select()->get();
            return view('application.setup', compact('countrys', 'continents'));
        })->name('application.setup');

        Route::get('/register/setup/v2', function () {
            return view('admin.dashboard');
        })->name('application.setup.v2');

        Route::get('/register/setup/submit', [accountSetupController::class, 'setup'])->name('application.setup.submit');
        Route::get('/register/setup/v2/submit', [accountSetupController::class, 'setupWardrobe'])->name('application.setup.v2.submit');


    });
