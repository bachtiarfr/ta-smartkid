@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ URL::to('admin/orangtua/' . $ortu->id) }}" method="post">
                @csrf
                @method("put")
                
                <label> Nama Depan</label>
                <input type="hidden" name="user_id" value="{{ $ortu->id }}">
                <input type="text" name="nama_depan" class="form-control" value="{{ $ortu->nama_depan }}">
                
                <label> Nama Belakang</label>
                <input type="text" name="nama_belakang" class="form-control" value="{{ $ortu->nama_belakang }}">

                <label> Status </label>
                <select name="status" class="form-control">
                    <option {{ $ortu->status == "ayah" ? "selected" : "" }} value="ayah"> Ayah </option>
                    <option {{ $ortu->status == "ibu" ? "selected" : "" }} value="ibu"> Ibu </option>
                    <option {{ $ortu->status == "wali" ? "selected" : "" }} value="wali"> Wali Murid </option>
                </select>

                <label> Nomer Induk Kependudukan </label>
                <input type="text" name="nik" class="form-control" value="{{ $ortu->nik }}">

                <label> Pendidikan Terakhir </label>
                <select name="pendidikan" class="form-control">
                    <option {{ $ortu->pendidikan == "sd" ? "selected" : "" }} value="sd"> Sekolah Dasar </option>
                    <option {{ $ortu->pendidikan == "smp" ? "selected" : "" }} value="smp"> Sekolah Menengah Pertama </option>
                    <option {{ $ortu->pendidikan == "sma/k" ? "selected" : "" }} value="sma/k"> Sekolah Menengah Atas/Kejuruan </option>
                    <option {{ $ortu->pendidikan == "s1" ? "selected" : "" }} value="s1"> Sarjanah Strata 1 </option>
                    <option {{ $ortu->pendidikan == "s2" ? "selected" : "" }} value="s2"> Sarjanah Strata 2 </option>
                    <option {{ $ortu->pendidikan == "s3" ? "selected" : "" }} value="s3"> Sarjanah Strata 3 </option>
                </select>

                <label> Pekerjaan </label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ $ortu->pekerjaan }}">

                <input type="submit" value="simpan" name="simpan" class="btn btn-success">
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop