<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HelperTrait;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;


class UserController extends Controller
{
    use HelperTrait, HasApiTokens;

    public function guard()
    {

        return Auth::guard('user');
    }

    public function register(Request $request)
    {
        if ($request->validate(['email' => 'required|email', 'name' => 'required', 'password' => 'required |min:6'])) {

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => $input['password'],
            ]);

            $success['token'] = $user->createToken('auth-token')->plainTextToken;
            $success['name'] = $user->name;

            return response()->json($success);
        } else {
            return $this->ReturnError(404, 'Invalid data');
        }


    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('auth-token')->plainTextToken;
            $success['name'] = $user->name;
            return $this->GetDataWithArray($success);
        } else {
            return $this->ReturnError(00);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        Auth::guard('web')->logout();
        return $this->GetDataWithArray($user);
    }
}
