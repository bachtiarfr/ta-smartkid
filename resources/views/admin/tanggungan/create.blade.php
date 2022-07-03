@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/tanggungan') }}" method="post">
        @csrf

        <label> Jumlah Tanggungan Anak Sekolah </label>
        <input type="text" name="jumlah" class="form-control">

        <label> Bobot / Nilai </label>
        <input type="text" name="nilai" class="form-control">

        <input type="submit" value="simpan" name="simpan" class="btn btn-success">

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop