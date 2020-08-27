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

                        <tr class="bg-danger">
                            <th>Payable Salary</th>
                            <td>:</td>
                            <td>{{$employee->payable()->payable_salary ?? '0'}} Tk.</td>
                        </tr>
                    </table>
                </div>
            </div>

        <form action="{{route('salary-payable.generate')}}" method="POST">
              {{ csrf_field() }}
                <input type="hidden" name="employee_id" value="{{$employee->id}}">
                <div class="form-row">
               <div class="form-group col-4">
                 <label for="month" class="text-capitalize">Month</label>
                 <select id="month" type="text" name="month" class="form-control @error('month') is-invalid @enderror">
                    <option value="">Choose Month</option>
                    @php
                               $m = [   1 => 'January',
                                        2 => 'February',
                                        3 => 'March',
                                        4 => 'April',
                                        5 => 'May',
                                        6 => 'June',
                                        7 => 'July',
                                        8 => 'August',
                                        9 => 'September',
                                        10 => 'October',
                                        11 => 'November',
                                        12 => 'December' ];
                                $dueMonth = $employee->payableMonths();
                           @endphp

                            @for ($month = 1; $month <= 12; $month++)
                            <option {{date('m') == $month ? 'selected' : ''}}  value="{{$month}}">{{$m[$month]}}</option>
                            @endfor
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