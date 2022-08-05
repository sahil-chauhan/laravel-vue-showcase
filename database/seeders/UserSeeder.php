<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password'),
                'access_level' => 0,
                'is_admin' => 0,
                'is_superadmin' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'access_level' => 0,
                'is_admin' => 1,
                'is_superadmin' => 0,
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'access_level' => 0,
                'is_admin' => 0,
                'is_superadmin' => 0,
            ]
        ];

        if( DB::table('users')->get()->count() == 0  )
        {
            DB::table('users')->insert($data);
        }
    }
}
