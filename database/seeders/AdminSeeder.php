<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Massi',
            'email' => 'admin@admin.de',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10)
        ]);

        $admin->save();
    }
}
