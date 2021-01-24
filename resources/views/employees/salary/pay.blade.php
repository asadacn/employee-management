@extends('adminlte::page')

@section('title', 'Salary - Payments')

@section('content_header')
<h1 class="h4 text-uppercase">Salary -Payments</h1>
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
        <div class="card">
            <div class="card-header h5">Employee Information</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Photo</th>
                        <td>:</td>
                        <td><img class="rounded"
                                src="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}"
                                alt="img" width="80px"></td>
                    </tr>
                    
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                    <td> <span class="badge px-4 {{$statusClass[$employee->status]}}">{{$status[$employee->status]}}</span></td>
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
                        <th>Monthly Salary</th>
                        <td>:</td>
                        <td>{{$employee->salary}} Tk.</td>
                    </tr>

                    @if ($employee->payables()->isNotEmpty())

                    <tr class="bg-secondary">
                        <th>Payable Salary - Last Month ({{$employee->payable() ? $m[$employee->payable()->month] : 'N/A'}})</th>
                        <td>:</td>
                        <td class="font-weight-bold">{{$employee->payable()->payable_salary ?? '0'}} Tk.</td>
                    </tr>
                    <tr class="bg-danger">
                        <th>Total Payable Salary</th>
                        <td>:</td>
                        <td class="font-weight-bold">{{$employee->total_due()}} Tk.</td>
                    </tr>

                    @endif

                </table>
            </div>
        </div>

        @if ($employee->payables()->isNotEmpty())
            
        <div class="card">
            <div class="card-header h5">Payable Salaries</div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="thead-light">
                        <th>Sn.</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Payable(Tk.)</th>
                        <th>Paid(Tk.)</th>
                        <th>Due(Tk.)</th>
                        <th>Leave</th>
                        <th>Leave Ignored</th>
                        <th> Paid</th>
                        <th>Action</th>
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
                                Pay
                              </button>
                            
                            
  
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$payable->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                                                    <label for="month" class="text-capitalize">Month </label>
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
                                                    <label for="amount" class="text-capitalize">salary amount</label>
                                                    <input type="text" class="form-control " name="amount" placeholder="Salary amount"
                                                        value="{{$employee->monthly_due($payable->month,$payable->year)}}">
                                                    @error('amount')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            <input type="hidden" name="payable_salary_id" value="{{$payable->id}}">
                                                <div class="form-group col-5">
                                                    <label for="paid_at" class="text-capitalize">Paid at</label>
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
                                            <button type="submit" class="btn btn-primary">Pay Salary</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                   
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

        <form action="{{route('salary-payable.generate')}}" method="POST">
            {{ csrf_field() }}
              <input type="hidden" name="employee_id" value="{{$employee->id}}">
              <div class="form-row">
             <div class="form-group col-4">
               <label for="month" class="text-capitalize">Month</label>
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
@if ($employee->payments()->isNotEmpty())
<div class="col-lg-6">
    <div class="card">
        <div class="card-header h5">Payments History</div>
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="thead-light ">
                    <th>Sn.</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Payable (Tk.)</th>
                    <th>Paid (Tk.)</th>
                    <th>Paid at (Date)</th>
                    <th>Paid_By</th>
                    <th>Status</th>
                </thead>
                @php
                    $i=1;
                @endphp
                <tbody>
                    @foreach ($employee->payments() as $payment)
                        <tr>
                        <td>{{$i++}}</td>
                        <td>{{$m[$payment->month]}}</td>
                        <td>{{$payment->salaryInfo->year}}</td>
                        <td>{{$payment->salaryInfo->payable_salary}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->paid_at}}</td>
                        <td>{{$payment->paid_by ?? 'N/A'}}</td>
                        <td class="text-center ">
                            <span class=" text-{{$payment->salaryInfo->is_paid == 'yes' ? 'success':'warning'}}">{!!$payment->salaryInfo->is_paid == 'yes' ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>' : '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg>'!!}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer"> 
            <small class="text-muted"> Payable : {{$employee->total_due() ?? 0}} Tk. | Paid : {{$employee->payments()->sum('amount') ?? '0'}} Tk.</small> <br>

        </div>
    </div>
</div>
@endif
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