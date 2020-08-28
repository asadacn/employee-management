<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\PayableSalary;
use App\SalaryPayment;
use Illuminate\Http\Request;

class SalaryPaymentController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.salary.pay',compact('employee'));
    }

    
    public function pay(Request $request)
    {
        $request->validate([
            'amount'   => 'numeric|required',
            'paid_at'  => 'required|date',
            'month'    => 'required|numeric'
        ]);

        $pay = new SalaryPayment();
        
        $pay->employee_id = $request->employee_id;
        $pay->payable_salary_id = $request->payable_salary_id;
        $pay->month = $request->month;
        $pay->amount = $request->amount;
        $pay->paid_at = $request->paid_at;

        if($pay->save()){
            
            $payable = PayableSalary::findOrFail($request->payable_salary_id);
            if ($request->amount >= $payable->payable_salary ) {
                $payable->is_paid = "Yes";
                $payable->save();
            }

            if($request->paid){
                $payable->is_paid = "Yes";
                $payable->save();
            }

            return redirect()->back()->with('success','Employee Salary Payment Successful');
        }else{
            return redirect()->back()->with('failed','Employee Salary Payment Failed');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
    public function EmployeePayments()
    {
        
    }
}
