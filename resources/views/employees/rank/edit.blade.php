@extends('adminlte::page')

@section('title', 'Rank - Add')

@section('content_header')
    <h1 class="h4 text-uppercase">Rank - Edit</h1>
@stop

@section('content')
    <div class="card w-50">
       <div class="card-header">Edit Rank</div>
        <div class="card-body">
        <form action="{{route('ranks.update',$rank->id)}}" method="POST">
            @method('PUT')
            @csrf
               <div class="form-group">
                 <label for="rank_title" class="text-capitalize">rank title</label>
               <input id="rank_title" type="text" name="rank_title" class="form-control @error('rank_title') is-invalid @enderror" placeholder="Ex. Manager / Director etc." value="{{$rank->title}}">
                 @error('rank_title')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                <label for="description" class="text-capitalize">description</label>
                <textarea id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Ex. Manager / Director etc.">{{$rank->description}}</textarea>
                @error('description')
                      <div class=" text-danger">{{ $message }}</div>
                 @enderror
              </div>
                <button type="submit" class="btn btn-primary">Save</button>
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