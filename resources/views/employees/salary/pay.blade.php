@extends('adminlte::page')

@section('title', 'Salary - Payments')

@section('content_header')
<h1 class="h5 text-uppercase">{{__('Salary Payments')}}</h1>
@stop

@section('content')
@php
$m = [ 
1 => 'January',
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

$status =[
    1=>'Active',
    2=>'Inactive',
    3=>'Closed'
];
$statusClass =[
    1=>'badge-success',
    2=>'badge-warning',
    3=>'badge-danger'
];
@endphp
<div class="row">
<div class="card col-lg-6">
    {{-- <div class="card-header h5"> Employee Salary</div> --}}
    <div class="card-body">

        @if ($employee->payables()->isNotEmpty())
            
        <div class="card">
            <div class="card-header h5">{{__('payable')}} {{__('salary')}}</div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="thead-light">
                        <th>{{__('SN.')}}</th>
                        <th>{{__('month')}}</th>
                        <th>{{__('year')}}</th>
                        <th>{{__('payable')}}({{__('Tk.')}})</th>
                        <th>{{__('paid')}}({{__('Tk.')}})</th>
                        <th>{{__('due')}}({{__('Tk.')}})</th>
                        <th>{{__('leave')}}</th>
                        <th>{{__('leave ignored')}}</th>
                        <th> {{__('paid')}}</th>
                        <th>{{__('action')}}</th>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                        @foreach ($employee->payables() as $payable)
                            <tr>
                            <td>{{$i++}}</td>
                            <td>{{$m[$payable->month]}}</td>
                            <td>{{$payable->year}}</td>
                            <td>{{$payable->payable_salary}}</td>
                            <td>{{$payable->payable_salary - $employee->monthly_due($payable->month,$payable->year)}}</td>
                            <td>{{$employee->monthly_due($payable->month,$payable->year)}}</td>
                            <td>{{$payable->leave ?? "N/A"}}</td>
                            <td class="text-uppercase">{{$payable->leave_ignore}}</td>
                            <td class="text-uppercase font-weight-bold">{{$payable->is_paid}}</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$payable->id}}">
                                {{__('pay salary')}}
                              </button>
                            
                            
  
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$payable->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{__('pay salary')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('salary-pay')}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                            <div class="form-row">
                                                <div class="form-group col-4">
                                                    <label for="month" class="text-capitalize">{{__('month')}} </label>
                                                    <select id="month" type="text" name="month"
                                                        class="form-control @error('month') is-invalid @enderror">
                                                        {{-- <option value="">Choose Month</option> --}}
                                                        <option  value="{{$payable->month}}">{{$m[$payable->month]}}</option>
                                                        {{-- @foreach ($employee->payableMonths() as $month)
                                                        <option {{date('m') == $month ? 'selected' : ''}} value="{{$month}}">{{$m[$month]}}</option>
                                                        @endforeach
                                 --}}
                                                    </select>
                                                    @error('month')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-3">
                                                    <label for="amount" class="text-capitalize">{{__('salary amount')}} ({{__('Tk.')}})</label>
                                                    <input type="text" class="form-control " name="amount" placeholder="Salary amount"
                                                        value="{{$employee->monthly_due($payable->month,$payable->year)}}">
                                                    @error('amount')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            <input type="hidden" name="payable_salary_id" value="{{$payable->id}}">
                                                <div class="form-group col-5">
                                                    <label for="paid_at" class="text-capitalize">{{__('date')}}</label>
                                                    <input id="paid_at" type="date" name="paid_at"
                                                        class="form-control @error('paid_at') is-invalid @enderror" value="{{date('Y-m-d')}}">
                                                    @error('paid_at')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                
                                            </div>
                                            {{-- <div class="form-group form-check">
                                                <input type="checkbox" name="paid" class="form-check-input" id="paid">
                                                <label class="form-check-label" for="paid">Paid</label>
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary">{{__('pay salary')}}</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                   
                                    </div>
                                </div>
                                </div>
                            </div>
                                                        
                            
                            
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header h5">{{__('Generate Salary')}}</div>
        <div class="card-body">
            <form action="{{route('salary-payable.generate')}}" method="POST">
                {{ csrf_field() }}
                  <input type="hidden" name="employee_id" value="{{$employee->id}}">
                  <div class="form-row">
                 <div class="form-group col-4">
                   <label for="month" class="text-capitalize">{{__('month')}}</label>
                   <select id="month" type="text" name="month" class="form-control @error('month') is-invalid @enderror">
                      <option value="">Choose Month</option>
                            @php
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
                  <label for="leave" class="text-capitalize">{{__('leave')}} ({{__('days')}})</label>
                  <input id="leave" type="text" name="leave" class="form-control @error('leave') is-invalid @enderror" placeholder="leave days">
                  @error('leave')
                        <div class=" text-danger">{{ $message }}</div>
                   @enderror
                </div>
                
              </div>
              <div class="form-group form-check">
                  <input type="checkbox" name="ignore_leave" class="form-check-input" id="ignore_leave">
                  <label class="form-check-label" for="ignore_leave">{{__('Ignore leave')}}</label>
            </div>
             
                  <button type="submit" class="btn btn-primary">{{__('Generate Salary')}}</button>
                </form>
        </div>
    </div>



    </div>
    <div class="card-footer">
        @include('employees.alert')
    </div>
</div>

<div class="col-lg-6">
    @include('employees.includes.employee-info')
    @if ($employee->payments()->isNotEmpty())
    @include('employees.includes.payment-details')
    @endif
</div>

</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop

@section('js')
<script>
   // console.log('Hi!');
</script>
@stop