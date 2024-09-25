<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnSocialController extends Controller
{
   public function runtime($id) {
       $errorcode = null;
       $errormsg = null;

       try {
          $fetch = \DB::table('users')->where('id', $id)->select(['google_id'])->get();
          foreach ($fetch as $fetch) {
              if ($fetch->google_id != null) {
                  $this->unGoogle($id);
              } else {
                  $this->unMeta($id);
              }
          }
       } catch (Exception $ex) {
           $errorcode = "5"; // Failed to fetch account type google or meta
           $errormsg = $ex;
       }

       switch ($errorcode) {
           case "1":
               return redirect()->back()->with('Error Code 1: Google', $errormsg);
               break;
           case "2":
               return redirect()->back()->with('Error Code 2: Meta', $errormsg);
               break;
           case  "3":
                return redirect()->back()->with('Error Code 3: Password dont Match', $errormsg);
                break;
           case "4":
                return redirect()->back()->with('Error Code 4: Password', $errormsg);
                break;
           case "5":
                return redirect()->back()->with('Error Code 5: Not an Google or Meta account', $errormsg);
                break;
           default:
                return redirect()->route('admin.dashboard-admins');
       }
   }

    public function unGoogle($id)
    {
        try {
            \DB::table('users')->where('id', $id)->update(['google_id' => null]);
            \DB::table('users')->where('id', $id)->update(['remember_token' => null]);
            \DB::table('users')->where('id', $id)->update(['acctype' => '0']);
            $this->setPassword($id);
        } catch (Exception $ex) {
            $errorcode = "1"; // Failed to update Tables Google
            $errormsg = $ex;
        }

    }
    //
    public function unMeta($id)
    {
        // error code 2 reserved


    }
    public function setPassword($id)
    {
        $newPassword = request('new-password');
        $confirmPass = request('confirm-new-pass');
        if ($newPassword != $confirmPass) {
            $errorcode = "3"; // Password not match
            $errormsg = "Password not match";
        } else {
            try {
                $hash = \Hash::make($newPassword);
                \DB::table('users')->where('id', $id)->update(['password' => $hash]);
            } catch (Exception $ex) {
                $errorcode = "4"; // Failed to update password
                $errormsg = $ex;
            }
        }
    }
}
