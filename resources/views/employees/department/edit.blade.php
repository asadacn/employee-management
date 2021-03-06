@extends('adminlte::page')

@section('title', 'Department - Edit')

@section('content_header')
    <h1 class="h4 text-uppercase">{{__('department')}} - {{__('edit')}}</h1>
@stop

@section('content')
    <div class="card col-md-6">
       <div class="card-header">{{__('edit')}} {{__('department')}}</div>
        <div class="card-body">
        <form action="{{route('departments.update',$department->id)}}" method="POST">
            @method('PUT')
            @csrf
               <div class="form-group">
                 <label for="department_title" class="text-capitalize">{{__('department')}} {{__('title')}}</label>
               <input id="department_title" type="text" name="department_title" class="form-control @error('department_title') is-invalid @enderror" placeholder="Ex. Manager / Director etc." value="{{$department->title}}">
                 @error('department_title')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                <label for="description" class="text-capitalize">{{__('description')}}</label>
                <textarea id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Ex. Manager / Director etc.">{{$department->description}}</textarea>
                @error('description')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
              </div>
                <button type="submit" class="btn btn-primary">{{__('save')}}</button>
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