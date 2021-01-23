<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayableSalary extends Model
{
protected $table = 'payable_salary';

public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
