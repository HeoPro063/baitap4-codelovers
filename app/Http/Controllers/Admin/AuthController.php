<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Repositories\Admin\Auth\AccountRepository;
class AuthController extends Controller
{
    //
    private $account;

    public function __construct(AccountRepository $account) {
        $this->account = $account;
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        $this->account->createAccount($request->all());
        $result_messange = 'Register successfully created';
        $result_status = 'alert-success';
        return redirect()->route('admin.login')->with('status-auth', $result_status)->with('messange-auth', $result_messange);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.home.index');
        }
        $result_messange = 'Your email or password is incorrect';
        $result_status = 'alert-danger';
        return back()->with('status-auth', $result_status)->with('messange-auth', $result_messange);
    }

    public function logout () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
