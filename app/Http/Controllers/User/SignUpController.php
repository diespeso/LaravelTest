<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use JwtAut;

class SignUpController extends Controller {
    public function __invoke(Request $request) {
        error_log('enters signup');
        $request->validate([
            'email' => 'required|string|max:255',
            'name' => 'required|string|min:4',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'error' => false,
        ]);
    }
}