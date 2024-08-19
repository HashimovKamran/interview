<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\OperationClaim;
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
        $user = User::create([
            'name' => 'Test user',
            'email' => 'test@example.com',
            'password' => Hash::make('123456789'),
        ]);
        $admin = OperationClaim::create(['name' => 'Admin']);
        $manager = OperationClaim::create(['name' => 'Manager']);
        $user->operationClaims()->attach($admin);
        $user->operationClaims()->attach($manager);
    }
}
