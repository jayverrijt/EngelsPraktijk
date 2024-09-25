<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class addUserController extends Controller
{
    public function runtime() {
        $name = null;
        $email = null;
        $password = null;
        $type = null;
        $acctype = null;

        if (request('adminUsername') != null) {
            $name = request('adminUsername');
            $email = request('adminEmail');
            $password = request('adminPassword');
            $type = 2;
            $acctype = 0;
            $this->add($name, $email, $password, $type, $acctype);
        } else {
            $name = request('shopUsername');
            $email = request('shopEmail');
            $password = request('shopPassword');
            $type = 1;
            $acctype = 0;
            $this->add($name, $email, $password, $type, $acctype);
        }
        return redirect()->route('admin.dashboard-admins');
    }

    public function add($name, $email, $password, $type, $acctype) {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->type = $type;
        $user->acctype = $acctype;
        $user->save();



    }
}
