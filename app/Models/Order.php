<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Order extends Controller
{
     public function showProfile()
    {
        $user = Auth::user();

        // Get the user's orders. This will be an empty collection for now.
        // We assume an 'orders' relationship exists on the User model.
        $orders = $user->orders()->latest()->get(); 

        return view('profile', [
            'user' => $user,
            'orders' => $orders
        ]);
    }
}