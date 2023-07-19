<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use JWTAuth;

class LoginControler extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): JsonResponse
    {
        $params = $request->only(['email', 'password']);
        $token = JWTAuth::attempt($params);
        
        $response = [];

        if ($token) {
            $found = User::where('email', '=', $params['email'])->first();
            /*$response['data'] = [
                'token' => $token,
            ];*/
            $response['data'] = $found;
        } else {
            $response['error'] = 'failed to login';
        }

        return response()->json($response, array_key_exists('data', $response) ? 200 : 403);
    }
}
