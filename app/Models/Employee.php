<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nip',
        'position',
        'gender',
        'address',
        'phone',
        'email',
    ];

    public function salary() {
        return $this->hasMany(Salary::class, 'employee_nip', 'nip');
    }
}
