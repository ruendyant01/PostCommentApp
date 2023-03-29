<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
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
        try {
            $user = User::where("email", $request->email)->firstOrFail();
            if(Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    "email" => "Token not valid"
                ]);
            };
            return $user->createToken("web")->plainTextToken;
        } catch (\Throwable $th) {
            return response($th->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
