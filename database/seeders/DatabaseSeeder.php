<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Task::factory(30)->create();

         \App\Models\User::factory()->create([
             'password' => '12345678',
             'email' => 'test@example.com',

         ]);
    }
}
