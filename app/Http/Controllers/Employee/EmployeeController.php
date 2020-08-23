<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::latest()->paginate(15);
        return view('employees.employee.index',compact('employees'));
    }


    public function create()
    {
        return view('employees.employee.create');
    }

    public function store(Request $request)
    {
          
        $request->validate([
            'employee_title' => 'required|unique:employees,title|max:100',
            'description' => 'string|nullable|max:255',
        ]);

            $employee = new Employee();
            $employee->title = $request->employee_title;
            $employee->description = $request->description;
            
            if($employee->save()){
                return redirect()->back()->with('success','Employee Created');
            }else{
                return redirect()->back()->with('failed','Employee Creation Failed');
            }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.employee.edit',compact('employee'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_title' => 'required|max:100|unique:employees,title,'.$id,
            'description' => 'string|nullable|max:255',
        ]);

            $employee = Employee::findOrFail($id);
            $employee->title = $request->employee_title;
            $employee->description = $request->description;
            
            if($employee->save()){
                return redirect()->back()->with('success','Employee Updated');
            }else{
                return redirect()->back()->with('failed','Employee Update Failed');
            }
    }


    public function destroy($id)
    {
        
        Employee::destroy($id);

        return redirect()->back()->with('success','Employee Deleted !');
    }

    public function search(Request $request)
    {
        $employees = Employee::where('title','like',"%".$request->search."%")->orWhere('description','like',"%".$request->search)->get();

        return view('employees.employee.index',compact('employees'));
    }
}
