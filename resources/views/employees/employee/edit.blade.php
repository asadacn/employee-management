@extends('adminlte::page')

@section('title', 'Employee - Add')

@section('content_header')
    <h1 class="h4 text-uppercase">{{__('Employee')}} - {{__('edit')}}</h1>
@stop

@section('content')
<div class="card col-lg-6">
  <div class="card-header">{{__('Edit Employee')}}</div>
   <div class="card-body">
   <form action="{{route('employees.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
@method('PUT')
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="department" class="text-capitalize">{{__('department')}}</label>
              <select id="department" type="text" name="department" class="form-control @error('department') is-invalid @enderror">
              <option value="">Choose Department {{$employee->status}}</option>
              @foreach (\App\Department::orderBy('title')->get() as $dept)
              <option  {{$employee->department_id == $dept->id ? 'selected' : ''}}  value="{{$dept->id}}">{{$dept->title}}</option>
              @endforeach
              </select>
              @error('department')
                  <div class=" text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-md-6">
              <label for="rank" class="text-capitalize">{{__('rank')}}</label>
              <select id="rank" type="text" name="rank" class="form-control @error('rank') is-invalid @enderror">
              <option value="">Choose Rank</option>
              @foreach (\App\Rank::orderBy('title')->get() as $dept)
              <option {{$employee->rank_id == $dept->id ? 'selected' : ''}} value="{{$dept->id}}">{{$dept->title}}</option>
              @endforeach
              </select>
              @error('rank')
                  <div class=" text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-8">
            <label for="employee_title" class="text-capitalize">{{__('employee')}} {{__('title')}}</label>
            <input id="employee_title" type="text" name="employee_name" class="form-control @error('employee_title') is-invalid @enderror" placeholder="Employee Title" value="{{$employee->name}}">
            @error('employee_title')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="birthday" class="text-capitalize">{{__('date of birth')}}</label>
            <input id="birthday" type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{$employee->date_of_birth}}">
            @error('birthday')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          </div>
        <div class="form-row">

          <div class="form-group col-md-4">
            <label for="contact_no" class="text-capitalize">{{__('contact no.')}}</label>
            <input id="contact_no" type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" placeholder="Contact No." value="{{$employee->contact_no}}">
            @error('contact_no')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="emg_contact_no" class="text-capitalize">{{__('emergency contact no.')}}</label>
            <input id="emg_contact_no" type="text" name="emergency_contact_no" autocomplete="mobile" class="form-control @error('emg_contact_no') is-invalid @enderror" placeholder="Emergency Contact No." value="{{$employee->emergency_contact_no}}">
            @error('emg_contact_no')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="blood_group" class="text-capitalize">{{__('blood group')}}</label>
            <input id="blood_group" type="text" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror" placeholder="Blood Group" value="{{$employee->blood_group}}">
            @error('blood_group')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>

        </div>

          <div class="form-group">
           <label for="address" class="text-capitalize">{{__('address')}}</label>
           <textarea id="address" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address"> {{$employee->address}}</textarea>
           @error('address')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
         </div>

         <div class="form-row">

          <div class="form-group col-md-6">
            <label for="salary" class="text-capitalize">{{__('salary')}}</label>
            <input id="salary" type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" placeholder="Salary" value="{{$employee->salary}}">
            @error('salary')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="hired_at" class="text-capitalize">{{__('hired at')}}</label>
            <input id="hired_at" type="date" name="hired_at" class="form-control @error('hired_at') is-invalid @enderror" placeholder="Blood Group" value="{{$employee->hired_at}}">
            @error('hired_at')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
        
        </div>

        <div class="form-row">

          <div class="form-group col-md-4">
            <label for="photo" class="text-capitalize">{{__('photo')}}</label>
            <input id="photo" type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" >
            <img class="shadow-sm rounded m-2" src="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}" alt="img" width="100px">
            @error('photo')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="nid" class="text-capitalize">{{__('NID')}}</label>
            <input id="nid" type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" placeholder="NID NO." value="{{$employee->nid}}">
            @error('nid')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>

          
          <div class="form-group col-md-4">
            <label for="status" class="text-capitalize">{{__('status')}}</label>
            <select id="status" type="text" name="status" class="form-control @error('status') is-invalid @enderror">
            <option value="">Choose Status</option>
            <option {{$employee->status == 1 ? 'selected' : ''}} value="1">Active</option>
            <option {{$employee->status == 2 ? 'selected' : ''}}  value="2">In-Active</option>
            <option {{$employee->status == 3 ? 'selected' : ''}}  value="3">Closed</option>
            </select>
            @error('status')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
        
        </div>
           <button type="submit" class="btn btn-primary">{{__('save')}}</button>
         </form>
   </div>
   <div class="card-footer">
    @include('employees.alert')
   </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop