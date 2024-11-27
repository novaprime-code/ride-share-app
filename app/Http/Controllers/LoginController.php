<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10'
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);

        if(!$user){
            return response()->json(['message' => 'Could not process a user with that phone number'], 401);
        }

        
        // $phone = $request->phone;
        // $user = User::where('phone', $phone)->first();
        // if ($user) {
        //     $login_code = rand(1000, 9999);
        //     $user->login_code = $login_code;
        //     $user->save();
        //     // send login code to user
        //     return response()->json(['message' => 'Login code sent to your phone']);
        // } else {
        //     return response()->json(['message' => 'User not found'], 404);
        // }
    }
}
