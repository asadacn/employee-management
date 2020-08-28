<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    public function salaryInfo()
    {
        return $this->belongsTo(PayableSalary::class,'payable_salary_id');
    }
}
