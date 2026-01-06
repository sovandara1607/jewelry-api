<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'admin';

    protected $fillable = ['admin_username', 'admin_email', 'admin_password'];
    protected $hidden = ['admin_password', 'remember_token'];
}
