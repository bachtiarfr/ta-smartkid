@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/pendaftar') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label> Nama Siswa </label>
        <select name="siswa_id" class="form-control">
            @foreach ($siswa as $s)
                <option value="{{ $s->id }}"> {{ $s->name }} </option>
            @endforeach
        </select>

        <label> Nama Orang Tua </label>
        <select name="ortu_id" class="form-control">
            @foreach ($ortu as $o)
                <option value="{{ $o->id }}"> {{ $o->name }} </option>
            @endforeach
        </select>

        <label> Beasiswa </label>
        <select name="periode_id" class="form-control">
            @foreach ($periode as $p)
                <option value="{{ $p->id }}"> {{ $p->nama_beasiswa }} </option>
            @endforeach
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