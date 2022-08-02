@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/periode/' . $periode->id ) }}" method="post">
        @csrf
        @method("put")

        <label> Nama Beasiswa </label>
        <select name="beasiswa_id" class="form-control">
            @foreach ($beasiswa as $b)
                <option {{ $periode->beasiswa_id == $b->id ? 'selected' : '' }} value="{{ $b->id }}"> {{ $b->nama_beasiswa }} </option>
            @endforeach
        </select>

        <label> Semester </label>
        <select name="semester" class="form-control">
            <option {{ $periode->semester == "Ganjil" ? "selected" : ""}} value="Ganjil"> Ganjil </option>
            <option {{ $periode->semester == "Genap" ? "selected" : ""}} value="Genap"> Genap </option>
        </select>

        <label> Tahun Ajaran </label>
        <input type="text" name="tahun" class="form-control" value="{{ $periode->tahun }}">

        <label> Status Beasiswa </label>
        <select name="status" class="form-control">
            <option {{ $periode->status == "Aktif" ? "selected" : ""}} value="Aktif"> Aktif </option>
            <option {{ $periode->status == "Non-Aktif" ? "selected" : ""}} value="Non-Aktif"> Non-Aktif </option>
        </select>

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