<?php 
namespace App\Repositories\User\Auth;

Interface UserRepository {
    public function getListUser();
    public function getUser($id);
    public function create(array $array);
    public function update(array $array);
    public function changePassword(array $array);

    public function disableStatus($id);
    public function activeStatus($id);
    public function active($id);
    public function delete($id);
    public function checkEmail($email);
    public function filterEmail(); 
}