@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .nav-link.dropdown-toggle::before {
            content: "Logout" !important;
        }
    </style>
<script src="{{ ('js/main.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                @if (Auth::user()->role_id == 1)
                <td> Aksi </td>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $sw)
                <tr>
                    {{-- <td>{{ $sw['id'] }}</td> --}}
                    <td>{{ ++$i }}</td>
                    <td>{{ $sw['nisn'] }}</td>
                    <td>{{ $sw['nama_depan'] . ' ' . $sw['nama_belakang'] }}</td>
                    <td>{{ $sw['jk'] }}</td>
                    <td>{{ $sw['kelas'] }}</td>
                    <td>{{ filterFileName( $sw['prestasi'] ) }}</td>
                    
                    @if (Auth::user()->role_id == 1)
                    <td>
                        <a class="btn btn-warning"  href=" {{ URL::to('admin/siswa/' . $sw['id'] . '/edit') }} "> EDIT </a>
                        @can('ortu-edit')
                        @endcan
                        {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                        @method('DELETE')
                        <a data-id="{{ $sw['id'] }}" id="btndelete" class="btn btn-danger" href="#"> DELETE </i></a>
                        @can('ortu-delete')
                            {{-- <a href="{{ URL::to('admin/hapussiswa/' . $sw['id'] ) }}"> <i class="fa fa-trash-o" style="font-size:24px"> </i></a> --}}
                        @endcan
                    </td>
                    @endif
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
            $("table").DataTable();
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
                        window.location.replace("/admin/hapussiswa/" + id );
                    } 
                });
            });

        });
    </script>
@stop