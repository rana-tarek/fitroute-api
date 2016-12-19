<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\PayloadFactory;
use JWTFactory;
use App\User;
use DB;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

class LoginController extends Controller
{
    public function generateGuestToken()
    {

        $guest = User::firstOrCreate(['name' => 'Guest', 'password' => md5('jan25'), 'email' => 'guest@guest.com']);
        // Generate JWT token
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::fromUser($guest)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(['token' => $token], 200); 
        return $this->response->array($token); 
    }

    public function getUser(Request $request)
    {
        $inputs = $request->all();
        
        $user = User::where('app_users.social_id', $inputs['social_id'])->orWhere('app_users.email', $inputs['email'])->first();
        if(!$user){
            $user = User::Create([
                'name'  => $inputs['name'],
                'email' => $inputs['email'],
                'image' => $inputs['image'],
                'social_id' => $inputs['social_id'],
                'social_type' => $inputs['social_type']
            ]);
        }
        else{
            if(isset($inputs['image']))
            {
                $user->image = $inputs['image'];
                $user->save();
            }
        }

        // Generate JWT token
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        $user['token'] = $token;
        return $this->response->array($user);
    }

}
