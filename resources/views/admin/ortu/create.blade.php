@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ URL::to('admin/orangtua') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label> Nama Orang Tua</label>
                <input type="text" name="nama_depan" class="form-control" placeholder="nama depan">
                <br>
                <input type="text" name="nama_belakang" class="form-control" placeholder="nama belakang">

                <label> Status </label>
                <select name="status" class="form-control">
                    <option selected value="ayah"> Ayah </option>
                    <option value="ibu"> Ibu </option>
                    <option value="wali"> Wali Murid </option>
                </select>

                <label> Nomer Induk Kependudukan </label>
                <input type="text" name="nik" class="form-control" required>

                <label> Pendidikan Terakhir </label>
                <select name="pendidikan" class="form-control">
                    <option value="sd"> Sekolah Dasar </option>
                    <option value="smp"> Sekolah Menengah Pertama </option>
                    <option selected value="sma/k"> Sekolah Menengah Atas/Kejuruan </option>
                    <option value="s1"> Sarjanah Strata 1 </option>
                    <option value="s2"> Sarjanah Strata 2 </option>
                    <option value="s3"> Sarjanah Strata 3 </option>
                </select>

                <label> Pekerjaan </label>
                <input type="text" name="pekerjaan" class="form-control">
                
                <label for="">Berkas Surat (kk, slip gaji dll)</label>
                <input type="file" name="berkas_surat" class="form-control">

                <input type="submit" value="simpan" name="simpan" class="btn btn-success">
            </form>
        </div>
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