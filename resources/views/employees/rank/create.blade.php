@extends('adminlte::page')

@section('title', 'Rank - Add')

@section('content_header')
    <h1 class="h4 text-uppercase">{{__('rank')}} - {{__('create')}}</h1>
@stop

@section('content')
    <div class="card col-md-6">
       <div class="card-header">{{__('Create Rank')}}</div>
        <div class="card-body">
        <form action="{{route('ranks.store')}}" method="POST">
              {{ csrf_field() }}
               <div class="form-group">
                 <label for="rank_title" class="text-capitalize">{{__('rank')}}  {{__('title')}}</label>
                 <input id="rank_title" type="text" name="rank_title" class="form-control @error('rank_title') is-invalid @enderror" placeholder="Ex. Manager / Director etc.">
                 @error('rank_title')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                <label for="description" class="text-capitalize">{{__('description')}}</label>
                <textarea id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Ex. Manager / Director etc."></textarea>
                @error('description')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
              </div>
                <button type="submit" class="btn btn-primary">{{__('submit')}}</button>
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