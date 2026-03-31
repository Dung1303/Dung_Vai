<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Cho phép lưu các cột này vào database
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Không bao giờ hiện mật khẩu và token khi xuất dữ liệu ra view/json
    protected $hidden = [
        'password',
        'remember_token',
    ];
}