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
            'employee_name' => 'required|max:100',
            'department' => 'required',
            'rank' => 'required',
            'contact_no' => 'numeric',
            'blood_group' => 'max:2',
            'emergency_contact_no' => 'numeric',
            'address' => 'string',
            'salary'=> 'numeric',
            'hired_at' => 'date',
            'photo' => 'file|size:2048',
            'nid' => 'max:17|min:13',
        ]);

            $employee = new Employee();
            $employee->name = $request->employee_title;
            $employee->department_id = $request->department;
            $employee->rank_id = $request->rank;
            $employee->contact_no = $request->contact_no;
            $employee->blood_group = $request->blood_group;
            $employee->emergency_contact_no = $request->emergency_contact_no;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->hired_at = $request->hired_at;
            $employee->nid = $request->nid;
            $employee->status = $request->status;
            $employee->save();

            
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
