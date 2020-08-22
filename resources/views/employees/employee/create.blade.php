@extends('adminlte::page')

@section('title', 'Rank - Add')

@section('content_header')
    <h1 class="h4 text-uppercase">Rank - Create</h1>
@stop

@section('content')
    <div class="card w-50">
       <div class="card-header">Create New Rank</div>
        <div class="card-body">
            <form >
               <div class="form-group">
                 <label for="rank_title" class="text-capitalize">rank title</label>
                 <input id="rank_title" type="text" name="rank_title" class="form-control" placeholder="Ex. Manager / Director etc.">
               </div>
               <div class="form-group">
                <label for="description" class="text-capitalize">description</label>
                <textarea id="description" type="text" name="description" class="form-control" placeholder="Ex. Manager / Director etc."></textarea>
              </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop