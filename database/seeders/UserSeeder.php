<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data pengguna ke dalam tabel users
        $user1 = new User([
            'name' => 'agim',
            'email' => 'agim@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1, 
        ]);
        $user1->save();

        $user2 = new User([
            'name' => 'maysarah',
            'email' => 'maysarah@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1, 
        ]);
        $user2->save();

        // Menambahkan lebih banyak data pengguna jika diperlukan
        $user3 = new User([
            'name' => 'cindy',
            'email' => 'cindy@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1, 
        ]);
        $user3->save();

        // Tambahkan lebih banyak data pengguna jika diperlukan
    }
}
