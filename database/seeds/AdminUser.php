<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profile;
class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
        	'name'=>'costumer', 
        	'description'=>'Costumer role',
        ]);
          $user = User::create([
            'email'=>'costumer@gmail.com',
            'password'=>bcrypt('secret'),
            'role_id'=>$role->id,
        ]);
         
        $role = Role::create([
        	'name'=>'admin',
        	'description'=>'admin role',
        ]);
        $user = User::create([
        	'email'=>'admin@admin.com',
        	'password'=>bcrypt('secret'),
        	'role_id'=>$role->id,
        ]);
         
        $profile = Profile::create([
        	'user_id'=>$user->id,
        ]);

    }
}

