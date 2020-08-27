<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function payable()
    {
        $payable = \App\PayableSalary::where('employee_id',$this->id)->where('is_paid','no')->latest()->first();
        return $payable;
    }
}
