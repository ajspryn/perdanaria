<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Daftar permissions yang ingin dibuat
    $permissions = [
      'user read',
      'user create',
      'user update',
      'user delete',
      // Tambahkan permissions lainnya di sini
    ];

    // Loop dan buat permissions
    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }
  }
}
