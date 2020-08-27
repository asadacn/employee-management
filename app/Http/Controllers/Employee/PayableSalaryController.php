<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\PayableSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayableSalaryController extends Controller
{
    public function index()
    {
        //
    }

    
    public function create()
    {
       //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'leave' => 'numeric|nullable',
            'month' => 'required'
        ]);

        
        $employee  =  Employee::findOrFail($request->employee_id);
        $payable_salary = 0;
        $year =date('Y');
            if($request->leave){
                $payable_salary = ($employee->salary * (30-$request->leave))/30;
            }
            if($request->ignore_leave){
                $payable_salary = $employee->salary;
            }

            $payable = new PayableSalary;
            $payable->employee_id = $request->employee_id ;
            $payable->leave = $request->leave ;
            $payable->leave_ignore = $request->ignore_leave =='on' ? 'Yes' : 'No';
            $payable->payable_salary = $payable_salary ;
            $payable->month = $request->month ;
            $payable->year = $year ;
            $payable->is_paid = $request->paid == 'on' ? 'Yes' : 'No';

            //$payable->save();

            if($payable->save()){
                return redirect()->back()->with('success','Employee Salary Generated');
            }else{
                return redirect()->back()->with('failed','Employee Salary Generation Failed');
            }
    }

   
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.salary.create',compact('employee'));
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
}
