<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $customerType = UserType::where('type_name','Customer')->first();
    User::factory()->count(10)->create([
      'user_type_id' => $customerType->id
    ]);
  }
}
