@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/penghasilan/' . $penghasilan->id ) }}" method="post">
        @csrf
        @method("put")

        <label> Range Penghasilan Orang Tua </label>
        <input type="text" name="penghasilan" class="form-control" value="{{ $penghasilan->penghasilan }}">

        <label> Bobot / Nilai </label>
        <input type="text" name="bobot" class="form-control" value="{{ $penghasilan->bobot }}">

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