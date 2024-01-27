<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginSession extends Model
{
    use HasFactory;

    protected $table = "users"; // Replace with your actual table name
    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'user_fullname',
        'user_type',
        'date_today',
        'login_time',
        'last_activity_time',
        'status',
        'duration',
        'first_name',
        'last_name',
        'employee_id',
        'email',
        'gender',
        'password',
        'address',
        'birth_day',
        'phone_number',
        'position',
        'department',
        'Status',
    ];
}
