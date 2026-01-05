<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
  public function run(): void
  {
    $types = [
      'admin' => 'Administrator role',
      'customer' => 'Customer role',
      'staff' => 'Staff role',
      'driver' => 'Driver role',
    ];

    foreach ($types as $type => $description) {
      UserType::updateOrCreate(
        ['type_name' => $type],
        ['description' => $description]
      );
    }
  }
}
