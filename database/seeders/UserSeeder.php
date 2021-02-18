<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'rachadian.novansyah15@gmail.com',
            'name' => 'Novan',
            'password' => Hash::make('qwerty123'),
            'status' => 'aktif'
        ]);
    }
}
