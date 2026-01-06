<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
   protected $model = Admin::class;

   /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {
      return [
         'admin_username' => fake()->userName(),
         'admin_email' => fake()->unique()->safeEmail(),
         'admin_password' => Hash::make('password'),
         'remember_token' => Str::random(10),
      ];
   }
}
