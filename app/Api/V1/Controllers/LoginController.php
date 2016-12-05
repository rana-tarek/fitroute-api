<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\PayloadFactory;
use JWTFactory;
use App\AppUser;
use DB;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

class LoginController extends Controller
{

    public function refreshToken(Request $request)
    {
        $token = $request->get('token');
        $newToken = JWTAuth::refresh($token);
        // return $this->response->array($newToken);
        return response()->json(['token' => $newToken], 200);  
    }


    public function setRegistration(Request $request)
    {
        $inputs = $request->all();
        if($inputs['user_id'])
        {
            $user = AppUser::find($inputs['user_id']);
            $user->registeration_id = $inputs['registeration_id'];
            $user->device_type = $inputs['device_type'];
            $user->save();
        }
        return response()->json(['status' => 'success'], 200);     
    }
}
