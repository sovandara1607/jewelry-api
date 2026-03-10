<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // API login (used by api.php routes)
    public function login(Request $req)
    {
        $admin_user = Admin::where('admin_email', $req->admin_email)->first();

        if (!$admin_user || !Hash::check($req->password, $admin_user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        return response()->json([
            'token' => $admin_user->createToken('admin-token')->plainTextToken,
        ]);
    }

    // Web: show admin login form
    public function AdminLoginForm()
    {
        return view('Management.AdminLogin');
    }

    // Web: process admin login via session
    public function Admin_login(Request $req)
    {
        $admin = Admin::where('admin_email', $req->admin_email)->first();

        if (!$admin || !Hash::check($req->password, $admin->password)) {
            return back()->withErrors(['message' => 'Invalid credentials.']);
        }

        session(['admin_id' => $admin->admin_id, 'admin_username' => $admin->admin_username]);
        return redirect('/Dashboard');
    }

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'admin_username'       => 'required|string|max:255',
            'admin_email'          => 'required|email|unique:admin,admin_email',
            'password'             => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $admin = Admin::create([
            'admin_username' => $req->admin_username,
            'admin_email'    => $req->admin_email,
            'password'       => bcrypt($req->password),
        ]);

        return response()->json([
            'message' => 'Admin registered successfully.',
            'token'   => $admin->createToken('admin-token', ['admin'])->plainTextToken,
            'admin'   => $admin,
        ], 201);
    }

    public function logout(Request $req)
    {
        $admin = $req->user('admin_api');

        if ($admin && $admin->currentAccessToken()) {
            $admin->currentAccessToken()->delete();
            return response()->json(['message' => 'Admin logged out successfully.']);
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    public function dashboard(Request $req)
    {
        return response()->json([
            'admin' => $req->user('admin_api'),
        ]);
    }
}
