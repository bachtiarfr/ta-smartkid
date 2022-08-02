@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/asuransi') }}" method="post">
        @csrf

        <label> Jenis Asuransi Kesehatan </label>
        <input type="text" name="nama" class="form-control">

        <label> Bobot / Nilai </label>
        <input type="text" name="nilai" class="form-control">

        <input type="submit" value="simpan" name="simpan" class="btn btn-success">

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .nav-link.dropdown-toggle::before {
            content: "Logout" !important;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop