<?php 

namespace App\Repositories\Admin\Auth;
use App\Models\Account;
use Hash;

class InterfaceAuth implements AccountRepository{
    private $model;

    public function __construct(Account $account) {
        $this->model = $account;
    }

    public function createAccount(array $array) {
        $this->model->name = $array['name'];
        $this->model->email = $array['email'];
        $this->model->password = Hash::make($array['password']);
        $this->model->save();
        return $this->model;        
    }

}
