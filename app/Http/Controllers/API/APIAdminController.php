<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIAdminController extends Controller
{
    use HelperTrait;

    public function postLogin(Request $request)
    {
        if ($this->validate($request, ['email' => 'required | email', 'password' => 'required']))
        {
            if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),])) {
                return $this->GetDataWithArray($request,'1' ,'Logged in' );
            } else {
                return $this->ReturnError('0' ,'User Not Found');
            }
        } else {
            return $this->ReturnError('3',);
        }

    }

    public function logout()
    {
        Auth::logout();
        return $this->GetDataWithArray('Done');
    }
}
