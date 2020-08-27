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
                        <td><img class="rounded" src="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}" alt="img" width="80px"></td>
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
                        <tr class="bg-danger">
                            <th>Payble Salary</th>
                            <td>:</td>
                            <td>{{$employee->payable()->payable_salary ?? '0'}} Tk.</td>
                        </tr>
                    </table>
                </div>
            </div>

        <form action="{{route('salary-payable.update')}}" method="POST">
              {{ csrf_field() }}
                <input type="hidden" name="employee_id" value="{{$employee->id}}">
                <div class="form-row">
               <div class="form-group col-4">
                 <label for="amount" class="text-capitalize">salary amount</label>
                 <input type="text" class="form-control " name="amount" placeholder="Salary amount" value="{{$employee->payable()->payable_salary ?? 0}}">
                 @error('amount')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group col-4">
                <label for="paid_at" class="text-capitalize">Paid at</label>
               <input id="paid_at" type="date" name="paid_at" class="form-control @error('paid_at') is-invalid @enderror" value="{{date('Y-m-d')}}">
                @error('paid_at')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
              </div>
              
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