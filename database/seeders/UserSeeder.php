<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@example.com',
            'tenant_id' => '1111111111',
            'balance' => 5000,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@example.com',
            'tenant_id' => '2222222222',
            'balance' => 5000,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User3',
            'email' => 'user3@example.com',
            'tenant_id' => '3333333333',
            'balance' => 5000,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User4',
            'email' => 'user4@example.com',
            'tenant_id' => '4444444444',
            'balance' => 5000,
        ]);
    }
}
