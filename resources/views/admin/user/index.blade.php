@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .nav-link.dropdown-toggle::before {
            content: "Logout" !important;
        }
    </style>
<script src="{{ ('js/main.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header alert-success">
                User
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="tblhasil" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                              <td>No</td>
                              <td>Name</td>
                              <td>Email</td>
                              <td>Roles</td>
                            </tr>
                        </thead>
                        <tbody id="v-content">
                          @php
                              $i = 1;
                          @endphp
                          @foreach ($data as $key => $user)
                          <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->nama_depan . ' ' . $user->nama_belakang }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
    <script>
        $(function () {
          $('table').DataTable();
        });
    </script>
@stop