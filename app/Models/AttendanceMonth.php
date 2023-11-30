<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceMonth extends Model
{
    use HasFactory;
    protected $table = 'attendance_employee_per_month';
}
