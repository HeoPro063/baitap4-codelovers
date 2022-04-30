<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\Auth\UserRepository;
class HomeController extends Controller
{
    //
    private $user;
    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    public function index () {
        $data = $this->user->getListUser();
        return view('admin.home.index', ['listUsers' => $data]);
    }
}
