<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
   public function run(): void
   {
      Admin::create([
         'admin_id' => 1,
         'admin_username' => 'srith3',
         'admin_email' => 'srith3@gmail.com',
         'password' => Hash::make('password'), // Replace with actual password
         'created_at' => '2025-07-10 09:59:29',
         'updated_at' => '2025-07-10 09:59:29',
      ]);

      // Reset PostgreSQL sequence
      DB::statement("SELECT setval(pg_get_serial_sequence('admin', 'admin_id'), (SELECT MAX(admin_id) FROM admin));");
   }
}
