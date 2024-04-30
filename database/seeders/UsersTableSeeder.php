<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->truncate();
        \App\Models\User::create([
            'name' => 'Reader',
            'email' => 'reader@brs.com',
            'password' => Hash::make('password'),
            'is_librarian' => false,
        ]);

        // Create a librarian
        \App\Models\User::create([
            'name' => 'Librarian',
            'email' => 'librarian@brs.com',
            'password' => Hash::make('password'),
            'is_librarian' => true,
        ]);

         \App\Models\User::factory(10)->create();
    }
}
