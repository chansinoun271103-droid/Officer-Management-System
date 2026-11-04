<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'dept_id';

    protected $fillable = ['name'];

    public function officers()
    {
        return $this->hasMany(Officer::class, 'dept_id', 'dept_id');
    }
}