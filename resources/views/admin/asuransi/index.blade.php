@extends('adminlte::page')

@section('title', 'Data Kriteria Asuransi')

@section('content_header')
    <h1>Data Kriteria Asuransi</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th> No </th>
            <th> Jenis Asuransi </th>
            <th> Bobot / Nilai </th>
            @if (Auth::user()->role_id == 1)
            <th>Action</th>
            @endif
        </tr>
        @foreach ($asuransi as $asr)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $asr->nama }}</td>
            <td>{{ $asr->nilai }}</td>
            @if (Auth::user()->role_id == 1)
            <td>
                <form action="{{ route('orangtua.destroy',$asr->id ) }}" method="POST">
                    {{-- <a href="#"> <i class="fa fa-eye" style="font-size:24px"></i> </a> --}}
                    <a class="btn btn-warning" href="{{ URL::to('admin/ubahasuransi/' . $asr->id ) }}"> Ubah </a>
                    {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                        
                    @csrf
                    @method('DELETE')
                    <a data-id="{{ $asr->id }}" id="btndelete" class="btn btn-danger" href="#"> Hapus </a>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
        </table>

        
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
                        window.location.replace("/admin/hapusasuransi/" + id );
                    } 
                });
            });

        });
    </script>
@stop