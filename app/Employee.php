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
        $payable = \App\PayableSalary::where('employee_id',$this->id)->where('is_paid','no')->orderBy('month','desc')->first();
        return $payable;
    }

    public function payables() //get all payable salaries
    {
        $payables = \App\PayableSalary::where('employee_id',$this->id)->where('is_paid','no')->latest()->get();
        return $payables;
    }

    public function payableMonths()
    {
        $month = \App\PayableSalary::where('employee_id',$this->id)->where('is_paid','no')->where('year',date('Y'))->pluck('month');
        return $month;
    }

    public function payments()
    {
        $payments = \App\SalaryPayment::where('employee_id',$this->id)->orderBy('paid_at')->get();
        return $payments;
    }
}
