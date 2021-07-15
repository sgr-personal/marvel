<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
//use Symfony\Component\HttpFoundation\Session\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Kreait\Firebase\Factory;
use Redirect,Response,File;
use Socialite;
use Auth;
use DB;

class SocialController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $usersData = DB::table('users')
                ->where('google_id', '=', $user->id)
                ->first();
            $msg = "Successfully logged in.";

            if($usersData){
                $usersData = (array)$usersData;
                $usersData['user_id'] = $usersData['id'];
                $request->session()->put('user', $usersData);
                return redirect()->route('home')->with('suc', $msg);
            }else{
                $newUserId = DB::table('users')->insertGetId([
                    'google_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile' => $user->avatar,
                    'password' => md5('ChangeMe@123'),
                ]);

                $usersData = DB::table('users')
                    ->where('id', '=', $newUserId)
                    ->first();

                $usersData = (array)$usersData;
                $usersData['user_id'] = $usersData['id'];
                $request->session()->put('user', $usersData);
                return redirect()->route('home')->with('suc', $msg);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
