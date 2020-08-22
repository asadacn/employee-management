@extends('adminlte::page')

@section('title', 'department - Add')

@section('content_header')
    <h1 class="h4 text-uppercase">department - Create</h1>
@stop

@section('content')
    <div class="card w-50">
       <div class="card-header">Create Department</div>
        <div class="card-body">
          <form action="{{route('departments.store')}}" method="POST">
            {{ csrf_field() }}
             <div class="form-group">
               <label for="department_title" class="text-capitalize">department title</label>
               <input id="department_title" type="text" name="department_title" class="form-control @error('department_title') is-invalid @enderror" placeholder="Ex. Manager / Director etc.">
               @error('department_title')
                    <div class=" text-danger">{{ $message }}</div>
               @enderror
             </div>
             <div class="form-group">
              <label for="description" class="text-capitalize">description</label>
              <textarea id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Ex. Manager / Director etc."></textarea>
              @error('description')
                    <div class=" text-danger">{{ $message }}</div>
               @enderror
            </div>
              <button type="submit" class="btn btn-primary">Submit</button>
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
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop