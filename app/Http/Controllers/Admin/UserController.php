<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\Auth\UserRepository;
class UserController extends Controller
{
    //
    private $user;

    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    public function disable($id) {
        $user = $this->user->getUser($id);            
        if($user) {
            $disable = $this->user->disableStatus($id);
            return redirect()->route('admin.home.index')->with('status', 'alert-danger')->with('message', 'Đã khóa người dùng: '.$user->email);
        }
        return redirect()->route('admin.home.index')->with('status', 'alert-danger')->with('message', 'Fail disable');
    }

    public function active($id) {
        $user = $this->user->getUser($id);            
        if($user) {
            $active = $this->user->activeStatus($id);
            return redirect()->route('admin.home.index')->with('status', 'alert-success')->with('message', 'Đã mở khóa thành công người dùng: '.$user->email);
        }
        return redirect()->route('admin.home.index')->with('status', 'alert-danger')->with('message', 'Fail active');
    }

    public function delete($id) {
        $user = $this->user->getUser($id);   
        $name = $user->email;         
        if($user && !$user->status){
            $this->user->delete($id);
            return redirect()->route('admin.home.index')->with('status', 'alert-success')->with('message', 'Đã xóa người dùng: '.$name);
        }
        return redirect()->route('admin.home.index')->with('status', 'alert-danger')->with('message', 'Fail Delete');
 
    }
    
}
