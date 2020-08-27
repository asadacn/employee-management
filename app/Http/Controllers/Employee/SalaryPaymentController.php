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

    
    public function store(Request $request)
    {
        //
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
}
