<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;
use Spatie\FlareClient\View;

class SettingsGroupController extends Controller
{
    public function runtime () {
        $group = request('buttonSettings');
        $privgroup = request('buttonSettingsPriv');
        $helpgroup = request('buttonSettingsHelp');
        $accgroup = request('buttonSettingsAcc');

        if($accgroup == 1) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            $systems = \DB::table('system')->where('foreign', \Auth::id())->select()->get();
            return view('application.layouts.settings.accountedit', compact('users', 'systems'));
        } else if ($accgroup == 2) {
            $tops = \DB::table('sizes')->select()->where('type', 0)->get();
            $pants = \DB::table('sizes')->select()->where('type', 1)->get();
            $shoes = \DB::table('sizes')->select()->where('type', 2)->get();
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            $systems = \DB::table('system')->where('foreign', \Auth::id())->select()->get();
            $countries = \DB::table('country')->select()->get();
            return view('application.layouts.settings.accountper', compact('users', 'systems', 'countries', 'tops', 'pants', 'shoes'));
        } else if ($accgroup == 3) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.accountchpass', compact('users'));
        } else if ($accgroup == 4) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.accountchemail', compact('users'));
        } else if ($accgroup == 5) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            $shops = \DB::table('shops')->select()->get();
            $prefs = \DB::table('pref-shops')->where('foreign', \Auth::id())->select()->get();
            return view('application.layouts.settings.accountpref', compact('users', 'shops', 'prefs'));
        };


        if ($privgroup == 1) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.privacypolicy', compact('users'));
        } else if ($privgroup == 2) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.privacytos', compact('users'));
        };

        if ($helpgroup == 1) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.helpprob', compact('users'));
        } else if ($helpgroup == 2) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.helpdesk', compact('users'));
        } else if ($helpgroup == 3) {
            $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
            return view('application.layouts.settings.helpabout', compact('users'));
        };

        switch($group) {
            case '1':
                $users = \DB::table('users')->where('id', \Auth::id())->select()->get();
                return view('application.layouts.settings.account', compact('users'));
                break;
            case '2':
                $notisettings = \DB::table('notification-settings')->select()->where('foreign', \Auth::id())->get();
                return view('application.layouts.settings.notifications', compact('notisettings'));
                break;
            case '4':
                return view('application.layouts.settings.privacy');
                break;
            case '3':
                return view('application.layouts.settings.help');
                break;
            default:
                return view('application.layouts.settings');
        }
    }
    public function updateEmail () {
        try {
            $password = request('password');
            $passhashes = \DB::table('users')->where('id', \Auth::id())->select('password')->get();
            foreach($passhashes as $passhash) {
                if(\Hash::check($password, $passhash->password)) {
                    $email = request('email');
                    $users = \DB::table('users')->where('id', \Auth::id())->update(['email' => $email]);
                    return redirect()->back()->with('success', 'Email updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Password is incorrect');
                }
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function updatePassword () {
        try {
            $password = request('password');
            $passhashes = \DB::table('users')->where('id', \Auth::id())->select('password')->get();
            foreach($passhashes as $passhash) {
                if(\Hash::check($password, $passhash->password)) {
                    $newPasswd = request('newPassword');
                    $repPasswd = request('newPasswordRep');
                    if ($newPasswd == $repPasswd) {
                        $hashednewPassword = \Hash::make($newPasswd);
                        $users = \DB::table('users')->where('id', \Auth::id())->update(['password' => $hashednewPassword]);
                    } else {
                        echo "Password Mismatched";
                    }
                } else {
                }

                return redirect()->back()->with('success', 'Password updated successfully');
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function updateAbout () {
        \DB::table('system')->where('foreign', \Auth::id())->update([
            'about' => request('text')
        ]);
        return redirect()->back();

    }
    public function updatePersonalInformation() {
        try {
            $continents = \DB::table('country')->select('continent_id')->where('id', request('country'))->get();
            foreach ($continents as $continent) {
                \DB::table('users')->where('id', \Auth::id())->update([
                    'name' => request('name'),
                ]);
                \DB::table('system')->where('foreign', \Auth::id())->update([
                    'country' => request('country'),
                    'city' => request('city'),
                    'continent' => $continent->continent_id,
                ]);
                \DB::table('size-manager')->where('foreign', \Auth::id())->update([
                    'top' => request('top'),
                    'pants' => request('pants'),
                    'shoes' => request('shoes'),
                ]);
                return redirect()->back()->with('success', 'Personal Information updated successfully');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function addFavShop() {
        $selected = request('shop');
        try {
            $fetchs = \DB::table('shops')->where('id', $selected)->select('type')->get();
            foreach($fetchs as $fetch) {
                if ($fetch->type == 1) {
                    $prefs = \DB::table('pref-shops')->where('foreign', \Auth::id())->select('s1', 's2', 's3', 's4', 's5')->get();
                    foreach ($prefs as $pref) {
                        if ($pref->s1 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['s1' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->s2 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['s2' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->s3 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['s3' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->s4 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['s4' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->s5 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['s5' => $selected]);
                            return redirect()->route('application.settings');
                        }
                    }
                }
                if ($fetch->type == 2) {
                    $prefs = \DB::table('pref-shops')->where('foreign', \Auth::id())->select('f1', 'f2', 'f3', 'f4', 'f5')->get();
                    foreach ($prefs as $pref) {
                        if ($pref->f1 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['f1' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->f2 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['f2' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->f3 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['f3' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->f4 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['f4' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->f5 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['f5' => $selected]);
                            return redirect()->route('application.settings');
                        }
                    }
                }
                if ($fetch->type == 3) {
                    $prefs = \DB::table('pref-shops')->where('foreign', \Auth::id())->select('a1', 'a2', 'a3', 'a4', 'a5')->get();
                    foreach ($prefs as $pref) {
                        if ($pref->a1 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['a1' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->a2 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['a2' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->a3 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['a3' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->a4 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['a4' => $selected]);
                            return redirect()->route('application.settings');
                        } else if ($pref->a5 == null) {
                            \DB::table('pref-shops')->where('foreign', \Auth::id())->update(['a5' => $selected]);
                            return redirect()->route('application.settings');
                        }
                    }
                }

            }


        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
