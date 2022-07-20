@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
 </tr>
 @php
     $i=0;
 @endphp
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->nama_depan . ' ' . $user->nama_belakang }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role }}</td>
  </tr>
 @endforeach
</table>



<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection