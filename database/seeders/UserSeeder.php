<?php

namespace Database\Seeders;

use Illuminate\Database\console\seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Neng admin',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'password'=>bcrypt('admin')
            ],
            [
                'name'=>'mang kasir',
                'email'=>'kasir@gmail.com',
                'role'=>'kasir',
                'password'=>bcrypt('123456'),
            ],
        ];

      foreach($userData as $key => $val){
        User::create($val);
      }
    }
}
