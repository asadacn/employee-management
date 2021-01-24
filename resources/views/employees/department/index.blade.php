@extends('adminlte::page')

@section('title', 'Department')

@section('content_header')
<h1 class="h4 text-uppercase">{{__('department')}} - {{__('list')}}</h1>
@stop

@section('content')
    <div class="card col-md-6">
    <div class="card-header">
        <form action="{{route('departments-search')}}" method="GET">
            @csrf
           <div class="form-row"> <a href="{{route('departments.create')}}" class="btn  btn-outline-secondary mr-1"><i class="fas fa-plus-circle"></i></a>
            <div class="input-group  w-50">
            
                <input type="search" class="form-control " name="search" placeholder="{{__('search')}} {{__('department')}}" aria-label="Search departments" aria-describedby="button-addon2" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">{{__('search')}}</button>
                </div>
            </form>
        </div>
          
       </div>
       @if(session()->has('success'))
       <div class="alert alert-success h5">
           {{ session()->get('success') }}
       </div>
        @endif
        <div class="card-body table-responsive">
            <table class="table table-border">
            <thead>
                <th>{{__('SN.')}}</th>
                <th>{{__('title')}}</th>
                <th>{{__('description')}}</th>
                <th>{{__('action')}}</th>
            </thead>
            <tbody>
                @if($departments->isEmpty())
                <tr>
                    <td colspan="4"> <div class="alert alert-secondary h4 text-center">{{__('NO DATA AVAILABLE')}}</div></td>
                </tr>
                @endif
               @php
                   $i=0;
               @endphp
                @foreach ($departments as $department)
                    <tr>
                    <td>{{++$i}}</td>
                    <td>{{$department->title}}</td>
                    <td>{{$department->description ?? "N/A"}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('departments.edit',$department->id)}}" class="btn btn-sm rounded-0 btn-secondary">{{__('edit')}} </a>
                        <form action="{{ route('departments.destroy', $department->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn rounded-0  btn-sm btn-danger" onclick="return confirm('Do you want to delete ?')" type="submit">{{__('delete')}} </button>
                          </form>
                          </div></td>
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