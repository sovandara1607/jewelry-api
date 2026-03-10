<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
   public function AllUsers()
   {
      $users = DB::select("
            SELECT name, email, phonenumber
            FROM users
            ORDER BY name ASC
        ");

      return view('Management.UserManagement', ['vdata' => $users]);
   }

   public function search(Request $req)
   {
      $search = $req->input('search');
      $users = DB::table('users')
         ->select('name', 'email', 'phonenumber')
         ->where('name', 'like', '%' . $search . '%')
         ->orWhere('email', 'like', '%' . $search . '%')
         ->get();

      return view('Management.UserManagement', ['vdata' => $users]);
   }

   public function filter_A()
   {
      return $this->filterByLetter('A');
   }
   public function filter_B()
   {
      return $this->filterByLetter('B');
   }
   public function filter_C()
   {
      return $this->filterByLetter('C');
   }
   public function filter_D()
   {
      return $this->filterByLetter('D');
   }
   public function filter_E()
   {
      return $this->filterByLetter('E');
   }
   public function filter_F()
   {
      return $this->filterByLetter('F');
   }
   public function filter_G()
   {
      return $this->filterByLetter('G');
   }

   private function filterByLetter(string $letter)
   {
      $users = DB::table('users')
         ->select('name', 'email', 'phonenumber')
         ->where('name', 'like', $letter . '%')
         ->orderBy('name', 'asc')
         ->get();

      return view('Management.UserManagement', ['vdata' => $users]);
   }
}
