<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
  public function run(): void
  {
    $types = ['Admin','Customer','Staff','Driver'];

    foreach ($types as $type) {
      UserType::create([
        'type_name' => $type,
        'description' => "$type role",
      ]);
    }
  }
}
