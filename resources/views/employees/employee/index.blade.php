@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<h1 class="h4 text-uppercase">Employee - List</h1>
@stop

@section('content')
    <div class="card col-lg-7">
    <div class="card-header">
        <form action="{{route('employees-search')}}" method="GET">
            @csrf
           <div class="form-row"> <a href="{{route('employees.create')}}" class="btn  btn-outline-secondary mr-1"><i class="fas fa-plus-circle"></i></a>
            <div class="input-group  w-50">
            
                <input type="search" class="form-control " name="search" placeholder="Search Employees" aria-label="Search Employees" aria-describedby="button-addon2" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
          
       </div>
       @if(session()->has('success'))
       <div class="alert alert-success h5 my-2">
           {{ session()->get('success') }}
       </div>
        @endif
        <div class="card-body table-responsive">
            <table class="table table-border">
            <thead class="text-uppercase">
                <th>SN.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Department</th>
                <th>Rank</th>
                <th>Contact</th>
            </thead>
            <tbody>
                @if($employees->isEmpty())
                <tr>
                    <td colspan="4"> <div class="alert alert-secondary h4 text-center">NO DATA AVAILABLE</div></td>
                </tr>
                @endif
               @php
                   $i=0;
               @endphp
                @foreach ($employees as $employee)
                    <tr>
                    <td>{{++$i}}</td>
                    <td><a href="{{$employee->photo ? asset('uploads/employee').'/'.$employee->photo : '#'}}"><img class="rounded shadow-sm" src="{{asset('uploads/employee')}}/{{$employee->photo}}" alt="img" width="50px"></a></td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->department->title}}</td>
                    <td>{{$employee->rank->title}}</td>
                    <td>{{$employee->contact_no}}</td>
                
                        <td>
                            <div class="btn-group mb-1" role="group">
                                <a href="{{route('employees.show',$employee->id)}}"
                                    class="btn btn-sm rounded-0 btn-primary">View</a>
                                <a href="{{route('employees.edit',$employee->id)}}"
                                    class="btn btn-sm rounded-0 btn-dark">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn rounded-0  btn-sm btn-danger"
                                        onclick="return confirm('Do you want to delete ?')"
                                        type="submit">Delete</button>
                                </form>
                            </div>

                            <div class="btn-group mb-1" role="group" >
                                <a href="{{route('salary-payable.create')}}"
                                    class="btn btn-sm rounded-0 btn-info">Generate Salary</a>
                                <a href="{{route('employees.edit',$employee->id)}}"
                                    class="btn btn-sm rounded-0 btn-warning">Pay Now</a>
                                
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