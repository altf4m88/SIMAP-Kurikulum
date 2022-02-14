<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Admin Kurikulum',
            'username' => 'KurikulumWikrama',
            'password' => Hash::make('Wikrama2022'),
            'role' => User::ADMIN,
            'status' => true,
        ];

        User::factory($user)->create();
    }
}
