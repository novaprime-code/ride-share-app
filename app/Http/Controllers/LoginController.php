<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNeedsVerification;
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

        $user->notify(new LoginNeedsVerification());

        return response()->json(['message' => 'Login code sent to your phone']);
        
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

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10',
            'login_code' => 'required|numeric|digits:6|between:111111,999999|exists:users,login_code'
        ]);

        $user = User::where('phone', $request->phone)->where('login_code', $request->login_code)->first();

        if($user){
            $user->login_code = null;
            $user->save();

            return $user->createToken($request->login_code)->plainTextToken;
        }
        if(!$user){
            return response()->json(['message' => 'Invalid login code'], 401);
        }





        return response()->json(['message' => 'Login successful']);
        
    }
}
