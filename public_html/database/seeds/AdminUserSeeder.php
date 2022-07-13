<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        dump('ADMIN USER SEEDER');
        $adminUser = new User();
        $adminUser->name='Admin';
        $adminUser->email='admin@kedemik.com';
        // $adminUser->paternal_surname='Admin';
        // $adminUser->maternal_surname='Admin';
        // $adminUser->business='Admin';
        // $adminUser->user_profile='/images/profile-empty.png';
        $adminUser->password =Hash::make('agt123');
        $adminUser->save();
    }
}
