<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class authentication extends Seeder
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
        ]);
         $user = User::create([
        	'email'=>'costumer@gmail.com',
        	'password'=>bcrypt('secret'),
        	'role_id'=>$role->id,
        ]);
        $role = Role::create([
        	'name'=>'admin',
        ]);
        $user = User::create([
        	'email'=>'admin@admin.com',
        	'password'=>bcrypt('secret'),
        	'role_id'=>$role->id,
        ]);

    }
}

