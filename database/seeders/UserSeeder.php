<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
   public function run(): void
   {
      $users = [
         [
            'id' => 1,
            'name' => 'Hanni Pham',
            'email' => 'hpham@gmail.com',
            'profilepic' => 'avatars/aImJ6QOxOwuaNBTmojRjxiIwQPeNjWOpTuOrilAB.jpg',
            'phonenumber' => '011 111 111',
            'address' => 'Phnom Penh',
            'password' => Hash::make('password'),
            'created_at' => '2025-07-07 13:13:51',
            'updated_at' => '2025-07-08 10:47:02',
         ],
         [
            'id' => 2,
            'name' => 'Stephanie Lu',
            'email' => 'slu@gmail.com',
            'profilepic' => 'avatars/ERszBadQXh1QjhiDtkaIF2gEH1tEwRjRvz6id2jh.jpg',
            'phonenumber' => '022 222 222',
            'address' => 'Phnom Penh',
            'password' => Hash::make('password'),
            'created_at' => '2025-07-07 13:19:20',
            'updated_at' => '2025-07-08 11:08:39',
         ],
         [
            'id' => 3,
            'name' => 'Chealinh Channnn',
            'email' => 'cchan@gmail.com',
            'profilepic' => 'avatars/Wtz3QqYSoRakKPsgm43ppoyNtPETBm0mrAWdmjfz.jpg',
            'phonenumber' => '033 333 333',
            'address' => 'Phnom Penh',
            'password' => Hash::make('password'),
            'created_at' => '2025-07-08 04:42:19',
            'updated_at' => '2025-07-08 10:20:13',
         ],
         [
            'id' => 4,
            'name' => 'Moneath Phan',
            'email' => 'mphan@gmail.com',
            'profilepic' => 'avatars/tmA9mPVEBC38sUOGHo8CxtodKK5r8r9KWJokujEY.jpg',
            'phonenumber' => '044 444 444',
            'address' => 'Phnom Penh',
            'password' => Hash::make('password'),
            'created_at' => '2025-07-08 10:22:48',
            'updated_at' => '2025-07-08 10:28:47',
         ],
         [
            'id' => 5,
            'name' => 'Tisa Song',
            'email' => 'tsong@gmail.com',
            'profilepic' => null,
            'phonenumber' => '055 555 555',
            'address' => 'Phnom Penh',
            'password' => Hash::make('password'),
            'created_at' => '2025-07-10 09:51:24',
            'updated_at' => '2025-07-10 09:51:24',
         ],
         [
            'id' => 6,
            'name' => 'Ratana Soth',
            'email' => 'rsoth@gmail.com',
            'profilepic' => 'avatars/S7KOVVHWdtPDLx1C7ixtPu7DrIK62ScWHuU3Wp5a.jpg',
            'phonenumber' => '066 666 633',
            'address' => 'Phnom Penh',
            'password' => Hash::make('password'),
            'created_at' => '2025-07-10 21:37:37',
            'updated_at' => '2025-07-10 21:38:30',
         ],
      ];

      foreach ($users as $user) {
         User::create($user);

         // Reset PostgreSQL sequence
         DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), (SELECT MAX(id) FROM users));");
      }
   }
}
