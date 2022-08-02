@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/tanggungan/' . $tanggungan->id ) }}" method="post">
        @csrf
        @method("put")

        <label> Jumlah Tanggungan Anak Sekolah </label>
        <input type="text" name="jumlah" class="form-control" value="{{ $tanggungan->jumlah }}">

        <label> Bobot / Nilai </label>
        <input type="text" name="nilai" class="form-control" value="{{ $tanggungan->nilai }}">

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