<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::truncate();
        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();
        $admin = Admin::create([
            'admin_name' => 'anhngoc',
            'admin_email' => 'ngoc@gmail.com',
            'admin_phone' => '2222',
            'admin_password' => md5('123456')
        ]);
        $author = Admin::create([
            'admin_name' => 'haphuong',
            'admin_email' => 'hp@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'hamy',
            'admin_email' => 'my@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'tonvu',
            'admin_email' => 'tv@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'chudu',
            'admin_email' => 'cd@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'luubaon',
            'admin_email' => 'lbo@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'chunguyenchuong',
            'admin_email' => 'cnc@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $author = Admin::create([
            'admin_name' => 'tudat',
            'admin_email' => 'td@gmail.com',
            'admin_phone' => '3333',
            'admin_password' => md5('123456')
        ]);
        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
