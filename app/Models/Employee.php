<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'employee_number',
        'username',
        'password',
        'first_name',
        'last_name',
        'email',
        'status'
    ];

    public function sales()
    {
        return $this->hasMany(Order::class);
    }
}
