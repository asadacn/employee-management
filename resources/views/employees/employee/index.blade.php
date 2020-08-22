@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
<div class="card w-75">
    <div class="card-header">
        <div class="form-row"> <a href="#" class="btn  btn-outline-secondary mr-1"><i class="fas fa-plus-circle"></i></a>
         <div class="input-group  w-50">
             <input type="text" class="form-control " placeholder="Search Ranks" aria-label="Search Ranks" aria-describedby="button-addon2">
             <div class="input-group-append">
               <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
             </div>
           </div>
       
    </div>
     <div class="card-body table-responsive">
         <table class="table table-border">
         <thead>
             <th>SN.</th>
             <th>Title</th>
             <th>Description</th>
             <th>Action</th>
         </thead>
         <tbody>
             <tr>
                 <td colspan="4"> <div class="alert alert-secondary h4 text-center">NO DATA AVAILABLE</div></td>
             </tr>
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