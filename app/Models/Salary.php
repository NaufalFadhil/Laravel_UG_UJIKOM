<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_nip',
        'salary',
        'bonus',
        'amount',
        'date'
    ];

    public function employee() {
        return $this->belongsTo('App\Employee', 'employee_nip', 'nip');
    }
}
