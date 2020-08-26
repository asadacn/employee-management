<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::latest()->paginate(15);
       // dd($employees);
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
            'contact_no' => 'nullable|numeric',
            'blood_group' => 'nullable|max:2',
            'emergency_contact_no' => 'nullable|numeric',
            'salary'=> 'nullable|numeric',
            'hired_at' => 'nullable|date',
            'birthday' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,bmp,png,gif|max:2048',
            'nid' => 'nullable|max:17|min:13',
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
            $employee->date_of_birth = $request->birthday;
            $employee->nid = $request->nid;
            $employee->status = $request->status;

            if($request->hasFile('photo')){
                // resizing an uploaded file
                $employee->photo = $this->imageUpload($request);
            }

           // $employee->save();

            
            if($employee->save()){
                return redirect()->back()->with('success','Employee Created');
            }else{
                return redirect()->back()->with('failed','Employee Creation Failed');
            }
    }


    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.employee.view',compact('employee'));
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.employee.edit',compact('employee'));
    }


    public function update(Request $request, $id)
    {
           
        $request->validate([
            'employee_name' => 'required|max:100',
            'department' => 'required',
            'rank' => 'required',
            'contact_no' => 'nullable|numeric',
            'blood_group' => 'nullable|max:2',
            'emergency_contact_no' => 'nullable|numeric',
            'salary'=> 'nullable|numeric',
            'hired_at' => 'nullable|date',
            'birthday' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,bmp,png,gif|max:2048',
            'nid' => 'nullable|max:17|min:13',
        ]);

            $employee = Employee::findOrFail($id);
            $employee->name = $request->employee_name;
            $employee->department_id = $request->department;
            $employee->rank_id = $request->rank;
            $employee->contact_no = $request->contact_no;
            $employee->blood_group = $request->blood_group;
            $employee->emergency_contact_no = $request->emergency_contact_no;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->hired_at = $request->hired_at;
            $employee->date_of_birth = $request->birthday;
            $employee->nid = $request->nid;
            $employee->status = $request->status;

            if($request->hasFile('photo')){
                // resizing and uploading file
                $employee->photo = $this->imageUpload($request);
            }
            
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
        $employees = Employee::where('name','like',"%".$request->search."%")
                                ->orWhere('contact_no','like',"%".$request->search)
                                ->orWhere('nid','like',"%".$request->search)
                                ->get();

        return view('employees.employee.index',compact('employees'));
    }

    protected function imageUpload(Request $request)
    {

         $fileName=null;

         if ($request->hasFile('photo')) {

          // read image from temporary file
            $img = Image::make($_FILES['photo']['tmp_name']);
            $img->encode('webp', 95);
            $fileName = 'employee-'.time().'.webp';

            // resize image
            $img->fit(400, 500)->sharpen(8)->save('uploads/employee/'.$fileName);
            // $img->resize(500, 500)->sharpen()->save(productImgCover().$fileName);
            // $img->resize(125, 120)->sharpen()->save(productImgThumbnil().$fileName);

          return $fileName;
        }
    }

}
