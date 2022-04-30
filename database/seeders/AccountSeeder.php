<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Repositories\Admin\Auth\AccountRepository;
class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(AccountRepository $account)
    {
        //
        $data = [
            'name' => 'Nguyễn Hào',
            'email' => 'admin@admin.com',
            'password' => '123123'
        ];
        $account->createAccount($data);
    }
}
