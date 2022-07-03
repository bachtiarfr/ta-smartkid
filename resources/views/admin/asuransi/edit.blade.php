@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/asuransi/' . $asuransi->id ) }}" method="post">
        @csrf
        @method("put")

        <label> Jenis Asuransi </label>
        <input type="text" name="nama" class="form-control" value="{{ $asuransi->nama }}">

        <label> Bobot / Nilai </label>
        <input type="text" name="nilai" class="form-control" value="{{ $asuransi->nilai }}">

        <input type="submit" value="simpan" name="simpan" class="btn btn-success">

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop