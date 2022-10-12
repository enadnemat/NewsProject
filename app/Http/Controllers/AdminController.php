<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    use AuthenticatesUsers;

    // get login page
    public function index()
    {
        return view('adminLogin');
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }


    //login into the page
    /**
     * @throws ValidationException
     */
    public function postLogin(Request $request)
    {

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
                return redirect('viewpost');
        }else {
            return 'Not logged in ';
        }
    }



}
