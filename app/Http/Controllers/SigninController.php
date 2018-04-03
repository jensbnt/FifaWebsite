<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SigninController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'name' => $request->input('name'),
            'password' => $request->input('password')
        ], $request->has('remember'))) {
            return redirect()->route('pages.index');
        } else {
            return redirect()->back()->with('fail', 'Authentication failed');
        }
    }

    public function getRegister() {
        return redirect()->route('auth.signin')->with('info', 'Registering has been disabled');
    }

    public function postRegister(Request $request) {
        return redirect()->route('auth.signin')->with('info', 'Registering has been disabled');
    }
}
