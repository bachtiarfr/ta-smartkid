@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/periode') }}" method="post">
        @csrf

        <label> Nama Beasiswa </label>
        <select name="beasiswa_id" class="form-control">
            @foreach ($beasiswa as $b)
                <option value="{{ $b->id }}"> {{ $b->nama_beasiswa }} </option>
            @endforeach
        </select>

        <label> Semester </label>
        <select name="semester" class="form-control">
            <option value="Ganjil"> Ganjil </option>
            <option value="Genap"> Genap </option>
        </select>

        <label> Tahun Ajaran </label>
        <input type="text" name="tahun" class="form-control">

        <label> Status Beasiswa </label>
        <select name="status" class="form-control">
            <option value="Aktif"> Aktif </option>
            <option value="Non-Aktif"> Non-Aktif </option>
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