<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lionheart = User::firstOrCreate([
            'name'=>'lionheart',
            'email'=>'ajabnoor@voxelx.com',
            'password'=>'$2y$10$xnqNHTV0KpZ7/OIoIh/Q/uk/mU3ePTfoFj98YHkTt0kXkugyqlS16',
            'remember_token'=>'Null',
            
        ]);
        $role = Role::create(['name' => 'admin']);
        $lionheart->assignRole('admin');
        // $permission = Permission::create(['name' => 'edit articles']);
        
        $wal = User::firstOrCreate([
            'name'=>'wal',
            'email'=>'support@voxelx.com',
            'password'=>'$2y$10$xnqNHTV0KpZ7/OIoIh/Q/uk/mU3ePTfoFj98YHkTt0kXkugyqlS16',
            'remember_token'=>'Null'
        ]);
        
        $sharaf = User::firstOrCreate([
            'name'=>'شرف',
            'email'=>'sharaf@voxelx.com',
            'password'=>'$2y$10$xnqNHTV0KpZ7/OIoIh/Q/uk/mU3ePTfoFj98YHkTt0kXkugyqlS16',
            'remember_token'=>'Null'
        ]);
    }
}
