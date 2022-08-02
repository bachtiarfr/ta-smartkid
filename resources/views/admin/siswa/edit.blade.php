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

        <Label> Nama Depan </Label>
        <input type="text" name="nama_depan" class="form-control" value="{{ $sw['nama_depan'] }}">
        
        <Label> Nama Belakang </Label>
        <input type="text" name="nama_belakang" class="form-control" value="{{ $sw['nama_belakang'] }}">

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
            <input type="hidden" name="list_of_prestasi" value="">

            <Label> Prestasi </Label>
            <div class="col-md-9 mb-3 form-inline">
                <a href="#" id="btnplus" class="btn btn-success btnPlus">Masukan prestasi + </a>
            </div>
            @for ($i = 0; $i < count ($sw['prestasi'] ) ; $i++)
                @if ($sw['prestasi'][$i] != null)
                <div class="col-md-9 form-inline dv_prestasi">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control prestasiName" name="prestasi{{ $i == 0 ? '' : $i }}" id="prestasi{{ $i == 0 ? '' : $i }}" class="form-control" value="{{ $sw['prestasi'][$i] }}" required>
                        <div class="btn btn-danger ml-2 btnDelete">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div> 
                @endif
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
    <style>
        .nav-link.dropdown-toggle::before {
            content: "Logout" !important;
        }
    </style>
@stop

@section('js')
    <script>
        
        $(function () {
            // membuat parameter
            let isi = '';
            let no = $('.dv_prestasi input').length;
            let jml_text = $('.dv_prestasi input').length;
            let btnPlus = ".btnPlus";
            let prestasiList = $(".dv_prestasi");
            let prestasi = [];

            $.each(prestasiList, function() {
                let val = $(this).find("input").val();
                prestasi.push(val)
            });

            $('#cnt_text').val( jml_text );

            let rows = $('#cnt_text').val();

            $(document).on("click", btnPlus, function() {
                // $('#dv_prestasi').clone().insertAfter('#dv_prestasi');

                // ambil form bagian input prestasi kemudian dicloning
                isi = `
                    <div class="col-md-9 form-inline" id="dv_prestasi">
                        <div class="form-group mb-3">
                            <input type="text" name="prestasi${no}" id="prestasi${no}" class="form-control">
                            <div class="btn btn-danger ml-2 btnDelete">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        
                    </div>
                `;

                no++;
                rows++;

                $('#cnt_text').val( rows );
                $('#group_prestasi').append( isi );
            })
            
            $(document).on("click", ".btnDelete", function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            })
        });
    </script>
@stop