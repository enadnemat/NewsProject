<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated()
    {
        if (Auth::check()) {
            return redirect()->route('login');
        }
    }

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
        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),])) {

            return redirect()->intended('posts/view');
        }

        return back()->withInput($request->only('email'));

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}
