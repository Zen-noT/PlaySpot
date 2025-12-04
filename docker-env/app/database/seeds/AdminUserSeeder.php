<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],  
            [
                'name' => 'Admin User',
                'password' => Hash::make('123456789'), 
                'role' => 3, 
                'icon' => null,
                'profile' => null,
            ]
        );
    }
}
