@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="col-md-8">
        <form action="{{ URL::to('admin/kondisi/' . $kondisi->id) }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method("put")

            <Label> Nama Orang Tua </Label>
            <select name="ortu_id" class="form-control">
                @foreach ($ortu as $or)
                    <option {{ $kondisi->ortu_id == $or->id ? "selected" : "" }} value="{{ $or->id }}"> {{ $or->name }} </option>
                @endforeach
            </select>
            
            <Label> Status Tempat Tinggal </Label>
            <select name="status_rumah" class="form-control">
                <option {{ $kondisi->status_rumah == "pribadi" ? "selected" : ""}} value="pribadi"> Rumah Pribadi </option>
                <option {{ $kondisi->status_rumah == "kontrak" ? "selected" : ""}} value="kontrak"> Rumah Kontrak </option>
                <option {{ $kondisi->status_rumah == "milik orangtua" ? "selected" : ""}} value="milik orangtua"> Rumah Orang Tua </option>
            </select>

            <Label> Bangunan Rumah </Label>
            <select name="level_bangunan" class="form-control">
                <option {{ $kondisi->level_bangunan == "permanen" ? "selected" : ""}} value="permanen"> Bangunan Permanen </option>
                <option {{ $kondisi->level_bangunan == "non-permanen" ? "selected" : ""}} value="non-permanen"> Bangunan Tidak Permanen </option>
            </select>

            <Label> Berkas Pajak Bangunan </Label>
            <input type="file" name="berkas_surat_pajak" class="form-control" value="{{ $kondisi->berkas_surat_pajak }}">
            <img style="width:250px; height:150px;" src="{{ asset('images/' . $kondisi->berkas_surat_pajak) }}" >
            
            <br>

            <Label> Foto Rumah Tempat Tinggal </Label>
            <input type="file" name="photo" class="form-control" value="{{ $kondisi->photo }}">
            <img style="width:250px; height:150px;" src="{{ asset('images/' . $kondisi->photo) }}" >

            <br> <br>

            <input type="submit" value="simpan" name="simpan" class="btn btn-success">
        </form>
    </div>
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