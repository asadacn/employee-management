<?php

namespace App\Http\Controllers\Employee;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(15);
        return view('employees.department.index',compact('departments'));
    }


    public function create()
    {
        return view('employees.department.create');
    }

    public function store(Request $request)
    {
          
        $request->validate([
            'department_title' => 'required|unique:departments,title|max:100',
            'description' => 'string|nullable|max:255',
        ]);

            $department = new department();
            $department->title = $request->department_title;
            $department->description = $request->description;
            
            if($department->save()){
                return redirect()->back()->with('success','Department Created');
            }else{
                return redirect()->back()->with('failed','Department Creation Failed');
            }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $department = department::findOrFail($id);
        return view('employees.department.edit',compact('department'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'department_title' => 'required|max:100|unique:departments,title,'.$id,
            'description' => 'string|nullable|max:255',
        ]);

            $department = Department::findOrFail($id);
            $department->title = $request->department_title;
            $department->description = $request->description;
            
            if($department->save()){
                return redirect()->back()->with('success','Department Updated');
            }else{
                return redirect()->back()->with('failed','Department Update Failed');
            }
    }


    public function destroy($id)
    {
        
        department::destroy($id);

        return redirect()->back()->with('success','department Deleted !');
    }

    public function search(Request $request)
    {
        $departments = department::where('title','like',"%".$request->search."%")->orWhere('description','like',"%".$request->search)->get();

        return view('employees.department.index',compact('departments'));
    }
}
