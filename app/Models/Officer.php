<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'name', 'gender', 'dob', 'email', 'phone',
        'position', 'hire_date', 'description', 'dept_id',
    ];

    protected $casts = [
        'dob'       => 'date',
        'hire_date' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    }
}