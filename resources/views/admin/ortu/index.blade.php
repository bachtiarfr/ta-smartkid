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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header alert-success">
                Data Orang Tua 
            </div>
            <div class="card-body">
            <div class="row">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="col-md-12">
                    <table id="tblhasil" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <td> No </td>
                                <td> NIK </td>
                                <td> NAMA LENGKAP </td>
                                <td> STATUS </td>
                                <td> PENDIDIKAN </td>
                                <td> PEKERJAAN </td>
                                @if (Auth::user()->role_id == 1)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="v-content">
                          @php
                              $i = 0;
                          @endphp
                            @foreach ($ortu as $ort)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $ort->nik }}</td>
                                <td>{{ $ort->nama_depan . " " . $ort->nama_belakang }}</td>
                                <td>{{ $ort->status }}</td> 
                                <td>{{ $ort->pendidikan }}</td>
                                <td>{{ $ort->pekerjaan }}</td>
                                @if (Auth::user()->role_id == 1)
                                <td>
                                    <form action="{{ route('orangtua.destroy',$ort->id ) }}" method="POST">
                                        <a class="btn btn-warning" href="{{ URL::to('admin/ubahortu/' . $ort->id ) }}"> Ubah </a>

                                        @csrf
                                        @method('DELETE')
                                        <a data-id="{{ $ort->id }}" id="btndelete" class="btn btn-danger" href="#"> Hapus </a>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
            </div>
        </div>
    </div>
</div>


@stop
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        
        $(function () {
            $('table').DataTable();
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
                        window.location.replace("/admin/hapusortu/" + id );
                    }
                });
                
            });
        });
    </script>
@stop