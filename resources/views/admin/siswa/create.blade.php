@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action="{{ URL::to('admin/siswa') }}" method="post" enctype="multipart/form-data" >
    @csrf

    <Label> Nomer Induk Siswa Nasional </Label>
    <input type="text" name="nisn" class="form-control">

    <Label> Nama Siswa </Label>
    <input type="text" name="nama" class="form-control">

    <label> Orang Tua / Wali </label>
    <select name="ortu_id" class="form-control">
        @foreach ( $ortu as $or)
            <option value="{{ $or->id }}"> {{ $or->name }} </option>
        @endforeach
    </select>

    <label> Jenis Kelamin </label>
    <select name="jk" class="form-control">
        <option value="L"> Laki-Laki</option>
        <option value="P"> Perempuan </option>
    </select>

    <label> Jurusan </label>
    <select name="jurusan" class="form-control">
        <option value="Teknik Kendaraan Ringan"> Teknik Kendaraan Ringan </option>
        <option value="Teknik Permesinan"> Teknik Permesinan </option>
        <option value="Teknik Komputer Jaringan"> Teknik Komputer Jaringan </option>
        <option value="Teknik Kimia Industri"> Teknik Kimia Industri </option>
    </select>

    <label> Kelas </label>
    <select name="kelas" class="form-control">
        <option value="X"> Kelas X </option>
        <option value="XI"> Kelas XI </option>
        <option value="XII"> Kelas XII </option>
    </select>

    <hr>

    <div id="group_prestasi">
        <div class="col-md-9 form-inline" id="dv_prestasi">
            <div class="form-group mb-3">
                <Label> Prestasi </Label>
                <input type="text" name="prestasi" id="prestasi" class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <button id="btnplus" class="btn btn-success"> + </button>
            </div>
        </div>
    </div>

    <hr>

    <label> Bukti Prestasi </label>
    <input type="file" name="berkas_prestasi" class="form-control">

    <input type="submit" value="simpan" name="simpan" class="btn btn-success">

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // membuat parameter
        let isi = '';
        let no = 1;

        $(function () {
            // kondisi jika diklik dengan jquery click
            $('#btnplus').click(function (e) { 
                e.preventDefault();
                // $('#dv_prestasi').clone().insertAfter('#dv_prestasi');

                // ambil form bagian input prestasi kemudia dicloning
                isi = `
                    <div class="col-md-9 form-inline" id="dv_prestasi">
                        <div class="form-group mb-3">
                            <Label> Prestasi </Label>
                            <input type="text" name="prestasi${no}" id="prestasi${no}" class="form-control">
                        </div>
                        
                    </div>
                `;

                no++;

                $('#group_prestasi').append( isi );
            });
        });
    </script>
@stop