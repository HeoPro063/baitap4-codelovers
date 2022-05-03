<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\Auth\UserRepository;
use Auth;
use Hash;
use App\Jobs\MailJob;

class AuthUserController extends Controller
{
    //

    private $user;

    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $user = $this->user->create($request->all());
        $this->SendMailActive($user);
        return redirect()->route('user.login')->with('status_success', 'Đăng kí thành công. Vui lòng xác thực tài khoản trong email (Lưu ý: Tài khoản sẽ bị vô hiệu quá sau 2 phút nếu không xác thực)');
    }

    public function SendMailActive($user) {
        MailJob::dispatch($user);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::guard('user')->user()->active == 0 ) {
                Auth::guard('user')->logout();
                return redirect()->route('user.login')->with('status_denger', "Bạn chưa xác thực tài khoản <a href=".route('auth-user-active')."> Click vào đây để tiến hành xác thực </a>");
            }
            if(Auth::guard('user')->user()->status == 0 ) {
                Auth::guard('user')->logout();
                return redirect()->route('user.login')->with('status_denger', "Tài khoản của bạn đã bị khóa");
            }
            return redirect()->route('user.home');
        }
        return redirect()->route('user.login')->with('status_denger', 'Đăng nhập thất bại');

    }

    public function active($id, $token) {
        $user =  $this->user->getUser($id);
        if($user) {
            if($user->token == $token) {
                $update =  $this->user->active($id);
                if($update) {
                    return redirect()->route('user.login')->with('status_success', 'Bạn đã xác thực tài khoản thành công');
                }                
            }
        }
        return redirect()->route('user.login')->with('status_denger', 'Lỗi xác thực');
    }

    public function reAuthActive(Request $request) {
        $check = $this->user->checkEmail($request->email);
        if($check->active == 0) {
            $this->SendMailActive($check);
            return redirect()->route('user.login')->with('status_success', 'Chúng tôi đã gửi thư xác thực đến email của bạn, vui lòng truy cập vào email của bạn để kích hoạt tài khoản.)');
        }
    }
    
    public function logout () {
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }

    public function mypage() {
        return view('user.mypage');
    }

    public function mypageEdit() {
        return view('user.mypageEdit');
    }

    public function postMypageEdit(Request $request) {
        $user = Auth::guard('user')->user();
        $request->validate([
            'name' => 'required',
        ]);

        $this->user->update($request->all());
        return redirect()->route('user.mypage')->with('status_success', 'Thay đổi thông tin thành công');
    }

    public function changePassword() {
        return view('user.changePassword');
    }

    public function postChangePassword(Request $request) {
        $request->validate([
            'password' => 'required',
            'password_new' => 'required|min:6',
            're_password_new' => 'required_with:password_new|same:password_new|min:6',
        ]);

        $id = Auth::guard('user')->id();
        $user = $this->user->getUser($id);
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('status_danger', 'Mật khẩu hiện tại không chính xác');
        }

        $this->user->changePassword($request->all());

        return redirect()->route('user.mypage')->with('status_success', 'Thay đổi mật khẩu thành công');
    }
   
}
