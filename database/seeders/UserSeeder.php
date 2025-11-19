<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    // ------------------------------------------------------------------
    // Create a specific admin user
    // ------------------------------------------------------------------
    User::factory()->admin()->create([
      'name' => 'Admin User',
      'email' => 'admin@example.com',
      'password' => bcrypt('admin123'), // specific password
    ]);

    // ------------------------------------------------------------------
    // Create additional random users
    // ------------------------------------------------------------------
    User::factory(10)->create();
  }
}
