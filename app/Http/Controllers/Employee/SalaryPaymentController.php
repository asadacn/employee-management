<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
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
