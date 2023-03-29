<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $request->validate([
            'email' => "required|email",
            'password' => "required|confirmed",
            "name" => "required"

        ]);
        try {
            $user = User::create($request->all());
            return response($user, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return response($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
