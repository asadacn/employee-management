@extends('adminlte::page')

@section('title', 'Salary - Generate')

@section('content_header')
    <h1 class="h4 text-uppercase">Salary - Generate</h1>
@stop

@section('content')
    <div class="card col-lg-6">
       <div class="card-header">Generate Employee Salary</div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">Employee Information</div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <tr>
                            <th>Photo</th>
                            <td>:</td>
                        <td><img class="rounded shadow-sm" src="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}" alt="img" width="80px"></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>:</td>
                            <td>{{$employee->name}}</td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td>:</td>
                            <td>{{$employee->contact_no}}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>:</td>
                            <td>{{$employee->department->title}}</td>
                        </tr>
                        <tr>
                            <th>Rank</th>
                            <td>:</td>
                            <td>{{$employee->rank->title}}</td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <td>:</td>
                            <td>{{$employee->salary}} Tk.</td>
                        </tr>
                    </table>
                </div>
            </div>

        <form action="{{route('salary-payable.store')}}" method="POST">
              {{ csrf_field() }}
                <input type="hidden" name="employee_id" value="{{$employee->id}}">
                <div class="form-row">
               <div class="form-group col-4">
                 <label for="month" class="text-capitalize">Month</label>
                 <select id="month" type="text" name="month" class="form-control @error('month') is-invalid @enderror">
                    <option value="">Choose Month</option>
                   
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select>
                 @error('month')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group col-4">
                <label for="leave" class="text-capitalize">leave (days)</label>
                <input id="leave" type="text" name="leave" class="form-control @error('leave') is-invalid @enderror" placeholder="leave days">
                @error('leave')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
              </div>
              
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="ignore_leave" class="form-check-input" id="ignore_leave">
                <label class="form-check-label" for="ignore_leave">Ignore leave</label>
          </div>
            <div class="form-group form-check">
                <input type="checkbox" name="paid" class="form-check-input" id="paid">
                <label class="form-check-label" for="paid">Paid</label>
          </div>
                <button type="submit" class="btn btn-primary">Generate Salary</button>
              </form>
        </div>
        <div class="card-footer">
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