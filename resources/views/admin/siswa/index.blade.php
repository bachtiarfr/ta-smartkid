@extends('adminlte::page')

@section('title', 'Data Siswa')

@section('content_header')
    <h1>Data Siswa</h1>
@stop

@section('content')

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <td> No </td>
                <td> NISN </td>
                <td> Nama Siswa </td>
                <td> Jenis Kelamin </td>
                <td> Kelas </td>
                <td> Prestasi </td>
                <td> Berkas Pretasi </td>
                <td> Aksi </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $sw)
                <tr>
                    {{-- <td>{{ $sw['id'] }}</td> --}}
                    <td>{{ ++$i }}</td>
                    <td>{{ $sw['nisn'] }}</td>
                    <td>{{ $sw['name'] }}</td>
                    <td>{{ $sw['jk'] }}</td>
                    <td>{{ $sw['kelas'] }}</td>
                    <td>{{ filterFileName( $sw['prestasi'] ) }}</td>
                    <td>
                        <img style="width:150px; height:100px;" src="{{ asset('images/' . $sw['berkas_prestasi']) }}">
                    </td>
                    <td>
                        @can('ortu-edit')
                            <a class="btn btn-warning"  href=" {{ URL::to('admin/siswa/' . $sw['id'] . '/edit') }} "> EDIT </a>
                        @endcan
                        {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                        @method('DELETE')
                        @can('ortu-delete')
                            <a data-id="{{ $sw['id'] }}" id="btndelete" class="btn btn-danger" href="#"> DELETE </i></a>
                            {{-- <a href="{{ URL::to('admin/hapussiswa/' . $sw['id'] ) }}"> <i class="fa fa-trash-o" style="font-size:24px"> </i></a> --}}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(function () {  
            $(document.body).on('click' , '#btndelete' , function (e) {
                e.preventDefault();
                let id = $(this).data("id");
                swal({
                    title: "Apakah anda yakin?",
                    text: "data yang dihapus tidak akan kembali!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("http://127.0.0.1:8000/admin/hapussiswa/" + id );
                    } 
                });
            });

        });
    </script>
@stop