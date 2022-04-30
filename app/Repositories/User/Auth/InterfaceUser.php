<?php

namespace App\Repositories\User\Auth;
use App\Models\User;
use Hash;
use Auth;
use Str;
class InterfaceUser implements UserRepository {
    private $model;

    public function __construct(User $user) {
        $this->model = $user;
    }
    public function getListUser() {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getUser($id) {
        return $this->model->find($id);
    }

    public function create(array $array) {
        $this->model->name = $array['name'];
        $this->model->email = $array['email'];
        $this->model->email_verified_at	 = date('Y-m-d H:i:s');
        $this->model->token = strtoupper(Str::random(10));
        $this->model->password = Hash::make($array['password']);
        $this->model->save();
        return $this->model;
    }

    public function update(array $array) {
        $user = Auth::guard('user')->user();
        $user->name = $array['name'];
        $user->email =  $array['email'];
        $user->save();
        return $user;
    }

    public function changePassword(array $array) {
        $user = Auth::guard('user')->user();
        $user->password = Hash::make( $array['password_new']);
        $user->save();
        return $user;
    }

    public function disableStatus($id) {
        $getUser = $this->getUser($id);
        $getUser->status = '0';
        $getUser->save();
        return true;
    }

    public function activeStatus($id) {
        $getUser = $this->getUser($id);
        $getUser->status = '1';
        $getUser->save();
        return true;
    }

    public function delete($id) {
        $this->getUser($id)->delete();
        return true;
    }

    public function active($id) {
        $getUser = $this->getUser($id);
        $getUser->token = '';
        $getUser->active = 1;
        $getUser->save();
        return true;
    }

    public function checkEmail($email) {
        return $this->model->where('email', $email)->firstOrFail();
    }
} 