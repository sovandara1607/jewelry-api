<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    protected $fillable = ['admin_username', 'admin_email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
