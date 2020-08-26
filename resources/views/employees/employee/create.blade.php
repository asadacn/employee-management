@extends('adminlte::page')

@section('title', 'Employee - Add')

@section('content_header')
    <h1 class="h4 text-uppercase">Employee - Create</h1>
@stop

@section('content')
<div class="card w-50">
  <div class="card-header">Create New Employee</div>
   <div class="card-body">
   <form action="{{route('employees.store')}}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="department" class="text-capitalize">department</label>
              <select id="department" type="text" name="department" class="form-control @error('department') is-invalid @enderror">
              <option value="">Choose Department</option>
              @foreach (\App\Department::orderBy('title')->get() as $dept)
              <option value="{{$dept->id}}">{{$dept->title}}</option>
              @endforeach
              </select>
              @error('department')
                  <div class=" text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group col-md-6">
              <label for="rank" class="text-capitalize">rank</label>
              <select id="rank" type="text" name="rank" class="form-control @error('rank') is-invalid @enderror">
              <option value="">Choose Rank</option>
              @foreach (\App\Rank::orderBy('title')->get() as $dept)
              <option value="{{$dept->id}}">{{$dept->title}}</option>
              @endforeach
              </select>
              @error('rank')
                  <div class=" text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-8">
            <label for="employee_title" class="text-capitalize">employee title</label>
            <input id="employee_title" type="text" name="employee_name" class="form-control @error('employee_title') is-invalid @enderror" placeholder="Employee Title" value="{{old('employee_name')}}">
            @error('employee_title')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="date_of_birth" class="text-capitalize">Date of Birth</label>
            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Employee Title" value="{{old('date_of_birth')}}">
            @error('date_of_birth')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          </div>
        <div class="form-row">

          <div class="form-group col-md-4">
            <label for="contact_no" class="text-capitalize">contact no.</label>
            <input id="contact_no" type="text" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" placeholder="Contact No." value="{{old('contact_no')}}">
            @error('contact_no')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="emg_contact_no" class="text-capitalize">Emergency contact no.</label>
            <input id="emg_contact_no" type="text" name="emergency_contact_no" autocomplete="mobile" class="form-control @error('emg_contact_no') is-invalid @enderror" placeholder="Emergency Contact No." value="{{old('emg_contact_no')}}">
            @error('emg_contact_no')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="blood_group" class="text-capitalize">blood group</label>
            <input id="blood_group" type="text" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror" placeholder="Blood Group" value="{{old('blood_group')}}">
            @error('blood_group')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>

        </div>

          <div class="form-group">
           <label for="address" class="text-capitalize">address</label>
           <textarea id="address" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address"> {{old('address')}}</textarea>
           @error('address')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
         </div>

         <div class="form-row">

          <div class="form-group col-md-6">
            <label for="salary" class="text-capitalize">salary</label>
            <input id="salary" type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" placeholder="Salary" value="{{old('salary')}}">
            @error('salary')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="hired_at" class="text-capitalize">hired at</label>
            <input id="hired_at" type="date" name="hired_at" class="form-control @error('hired_at') is-invalid @enderror" placeholder="Blood Group" value="{{old('hired_at')}}">
            @error('hired_at')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
        
        </div>

        <div class="form-row">

          <div class="form-group col-md-4">
            <label for="photo" class="text-capitalize">Photo</label>
            <input id="photo" type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" value="{{old('photo')}}">
            @error('photo')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-4">
            <label for="nid" class="text-capitalize">NID</label>
            <input id="nid" type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" placeholder="NID NO." value="{{old('nid')}}">
            @error('nid')
                 <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>

          
          <div class="form-group col-md-4">
            <label for="status" class="text-capitalize">status</label>
            <select id="status" type="text" name="status" class="form-control @error('status') is-invalid @enderror">
            <option value="">Choose Status</option>
            <option value="1">Active</option>
            <option value="2">In-Active</option>
            <option value="3">Closed</option>
            </select>
            @error('status')
                <div class=" text-danger">{{ $message }}</div>
            @enderror
          </div>
        
        </div>
           <button type="submit" class="btn btn-primary">Submit</button>
         </form>
   </div>
   <div class="card-footer">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
       @if(session()->has('success'))
       <div class="alert alert-success h5">
           {{ session()->get('success') }}
       </div>
       @endif
       @if(session()->has('failed'))
       <div class="alert alert-danger h5">
           {{ session()->get('failed') }}
       </div>
       @endif
   </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop