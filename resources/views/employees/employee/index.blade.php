@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<h1 class="h4 text-uppercase">Employee - List</h1>
@stop

@section('content')
    <div class="card col-lg-10">
    <div class="card-header ">
        <form action="{{route('employees-search')}}" method="GET">
            @csrf
           <div class="form-row pl-4 py-2"> 
            <div class="input-group  col-lg-5">
                <div  class="input-group-prepend"> <a href="{{route('employees.create')}}" class="btn  btn-outline-secondary "><i class="fas fa-plus-circle"></i></a></div>
           
                <input type="search" class="form-control " name="search" placeholder="Search Employees" aria-label="Search Employees" aria-describedby="button-addon2" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
            </form>
        </div>
     
        @php
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
       
       @if(session()->has('success'))
       <div class="alert alert-success h5 my-2">
           {{ session()->get('success') }}
       </div>
        @endif
        <div class="card-body table-responsive">
            <table class="table table-bordered">
            <thead class="text-uppercase thead-light">
                <th>SN.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Department</th>
                <th>Rank</th>
                <th>Contact</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @if($employees->isEmpty())
                <tr>
                    <td colspan="7"> <div class="alert alert-secondary h4 text-center">NO DATA AVAILABLE</div></td>
                </tr>
                @endif
               @php
                   $i=0;
               @endphp
                @foreach ($employees as $employee)
                    <tr>
                    <td>{{++$i}}</td>
                    <td><a href="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}"><img class="rounded shadow-sm" src="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : asset('uploads/employee').'/'.'avatar.jpg'}}" alt="img" width="50px"></a></td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->department->title}}</td>
                    <td>{{$employee->rank->title}}</td>
                    <td>{{$employee->contact_no}}</td>
                    <td ><span class=" badge badge-pill  {{$statusClass[$employee->status]}}"> {{$status[$employee->status]}} </span></td>
                
                        <td class="text-center">
                            <div class="btn-group mb-2 shadow-sm" role="group">
                                <a href="{{route('employees.show',$employee->id)}}"
                                 title="View"   class="btn btn-sm rounded-0 btn-light"> <i class="fas fa-eye"></i></a>
                                <a href="{{route('employees.edit',$employee->id)}}"
                                  title="Edit"  class="btn btn-sm rounded-0 btn-light"> <i class="fas fa-user-edit"></i></a>
                                <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn rounded-0  btn-sm btn-light"
                                      title="Delete"  onclick="return confirm('Do you want to delete ?')"
                                        type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                {{-- <a title="Generate Salary" href="{{route('salary-payable.create')}}"
                                class="btn btn-sm  btn-outline-dark">Salary</a>
                            <a title="Pay Salary" href="{{route('employees.edit',$employee->id)}}"
                                class="btn btn-sm  btn-outline-dark">Pay </a> --}}
                            </div>

                            <div class="btn-group mb-2 shadow-sm" role="group" >
                                {{-- <a title="Generate Salary" href="{{route('salary-payable.create',$employee->id)}}"
                                class="btn btn-sm  btn-outline-dark">Salary</a> --}}
                            <a title="Pay Salary" href="{{route('salary-pay.create',$employee->id)}}"
                                class="btn btn-sm  btn-outline-dark">Salary </a>
                                {{-- <a title="Salary Payments History" href="{{route('salary-pay.create',$employee->id)}}"
                                    class="btn btn-sm  btn-outline-dark">Payments </a> --}}
                                
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop