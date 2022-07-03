@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @foreach ($siswa as $sw)
        <form action="{{ URL::to('admin/siswa/' . $sw['id'] ) }}" method="post" enctype="multipart/form-data" >
        @csrf
        @method('put')

        <Label> Nomer Induk Siswa Nasional </Label>
        <input type="text" name="nisn" class="form-control" value="{{ $sw['nisn'] }}">

        <Label> Nama Siswa </Label>
        <input type="text" name="nama" class="form-control" value="{{ $sw['name'] }}">

        <label> Jenis Kelamin </label>
        <select name="jk" class="form-control">
            <option {{ $sw['jk'] == 'L' ? 'selected' : '' }}  value="L"> Laki-Laki</option>
            <option {{ $sw['jk'] == 'P' ? 'selected' : '' }} value="P"> Perempuan </option>
        </select>

        <label> Jurusan </label>
        <select name="jurusan" class="form-control">
            <option {{ $sw['jurusan'] == 'Teknik Kendaraan Ringan' ? 'selected' : '' }} value="Teknik Kendaraan Ringan"> Teknik Kendaraan Ringan </option>
            <option {{ $sw['jurusan'] == 'Teknik Permesinan' ? 'selected' : '' }} value="Teknik Permesinan"> Teknik Permesinan </option>
            <option {{ $sw['jurusan'] == 'Teknik Komputer Jaringan' ? 'selected' : '' }} value="Teknik Komputer Jaringan"> Teknik Komputer Jaringan </option>
            <option {{ $sw['jurusan'] == 'Teknik Kimia Industri' ? 'selected' : '' }} value="Teknik Kimia Industri"> Teknik Kimia Industri </option>
        </select>

        <label> Kelas </label>
        <select name="kelas" class="form-control">
            <option {{ $sw['kelas'] == 'X' ? 'selected' : '' }} value="X"> Kelas X </option>
            <option {{ $sw['kelas'] == 'XI' ? 'selected' : '' }} value="XI"> Kelas XI </option>
            <option {{ $sw['kelas'] == 'XII' ? 'selected' : '' }} value="XII"> Kelas XII </option>
        </select>

        <hr>

        <div id="group_prestasi">

            <Label> Prestasi </Label>

            @for ($i = 0; $i < count ($sw['prestasi'] ) ; $i++)
                <div class="col-md-9 form-inline" id="dv_prestasi">
                    <div class="form-group mb-3">
                        <input type="text" name="prestasi{{ $i == 0 ? '' : $i }}" id="prestasi{{ $i == 0 ? '' : $i }}" class="form-control" value="{{ $sw['prestasi'][$i] }}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <button id="btnplus" class="btn btn-success"> + </button>
                    </div>
                </div> 
            @endfor

        </div>

        <hr>

        <label> Bukti Prestasi </label>
        <input type="file" name="berkas_prestasi" class="form-control" value="{{ $sw['berkas_prestasi'] }}">
        <img style="width:250px; height:150px;" src="{{ asset('images/' . $sw['berkas_prestasi']) }}" >

        <hr>
        
        <input type="submit" value="simpan" name="simpan" class="btn btn-success">

        <input type="hidden" name="cnt_text" id="cnt_text">
        </form>
    @endforeach
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        
        $(function () {
            // membuat parameter
            let isi = '';
            let no = $('#dv_prestasi input').length;
            let jml_text = $('#dv_prestasi input').length;

            $('#cnt_text').val( jml_text );

            let rows = $('#cnt_text').val();

            // kondisi jika diklik dengan jquery click
            $('#btnplus').click(function (e) { 
                e.preventDefault();
                // $('#dv_prestasi').clone().insertAfter('#dv_prestasi');

                // ambil form bagian input prestasi kemudian dicloning
                isi = `
                    <div class="col-md-9 form-inline" id="dv_prestasi">
                        <div class="form-group mb-3">
                            <input type="text" name="prestasi${no}" id="prestasi${no}" class="form-control">
                        </div>
                        
                    </div>
                `;

                no++;

                rows++;

                $('#cnt_text').val( rows );

                $('#group_prestasi').append( isi );
            });
        });
    </script>
@stop