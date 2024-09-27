<?php

namespace App\Http\Controllers\EngelsPraktijk\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreationRequest;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //TODO handle Authentication

    public function index() {
        $users = User::all();

        return $users;
    }

    public function store(UserCreationRequest $request) {
        $validatedData = $request->validated();
        $user = User::create($validatedData);

        return $user;
    }

    public function show($userId) {
        $user = User::find($userId);
        
        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
    }

    public function update(Request $request) {
        //Update Class, Password / email would require more verification 
        //and be done in a seperate controller.
        if ($request['class'] == null) {
            return response()->json(['message' => 'New class is empty.'], 400);
        }        
        //TODO when classes are implemented
    }

    public function destroy($userId) {
        $user = User::find($userId);
        
        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }     
        
        $user->delete();
        return response()->json(['message' => 'User Deleted'], 200);
    }
}
