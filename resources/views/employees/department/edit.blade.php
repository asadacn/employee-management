@extends('adminlte::page')

@section('title', 'Department - Edit')

@section('content_header')
    <h1 class="h4 text-uppercase">department - Edit</h1>
@stop

@section('content')
    <div class="card w-50">
       <div class="card-header">Edit department</div>
        <div class="card-body">
        <form action="{{route('departments.update',$department->id)}}" method="POST">
            @method('PUT')
            @csrf
               <div class="form-group">
                 <label for="department_title" class="text-capitalize">department title</label>
               <input id="department_title" type="text" name="department_title" class="form-control @error('department_title') is-invalid @enderror" placeholder="Ex. Manager / Director etc." value="{{$department->title}}">
                 @error('department_title')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                <label for="description" class="text-capitalize">description</label>
                <textarea id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Ex. Manager / Director etc.">{{$department->description}}</textarea>
                @error('description')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
              </div>
                <button type="submit" class="btn btn-primary">Save</button>
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