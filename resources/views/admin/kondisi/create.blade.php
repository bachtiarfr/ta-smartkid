@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/kondisi') }}" method="post" enctype="multipart/form-data" >
    @csrf

    <label> Nama Orang Tua </label>
    <select name="ortu_id" class="form-control">
        @foreach ($ortu as $or)
            <option value="{{ $or->id }}"> {{ $or->name }} </option>
        @endforeach
    </select>

    <label> Status Tempat Tinggal </label>
    <select name="status_rumah" class="form-control">
        <option value="pribadi"> Rumah Pribadi </option>
        <option value="kontrak"> Rumah Kontrak / Sewa </option>
        <option value="milik orangtua"> Rumah Milik Orang Tua </option>
    </select>

    <label> Level Bangunan </label>
    <select name="level_bangunan" class="form-control">
        <option value="permanen"> Rumah Permanen </option>
        <option value="non-permanen"> Rumah Non-Permanen </option>
    </select>

    <label> Berkas Surat Pajak </label>
    <input type="file" name="berkas_surat_pajak" class="form-control">

    <label> Foto Rumah </label>
    <input type="file" name="photo" class="form-control">

    <input type="submit" value="simpan" name="simpan" class="btn btn-success">

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop