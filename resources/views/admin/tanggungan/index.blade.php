@extends('adminlte::page')

@section('title', 'Data Kriteria Tanggungan Anak')

@section('content_header')
    <h1>Data Kriteria Tanggungan Anak</h1>
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
            <th> Tanggungan Anak Sekolah </th>
            <th> Bobot / Nilai </th>
            <th>Action</th>
        </tr>
        @foreach ($tanggungan as $tgn)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $tgn->jumlah }}</td>
            <td>{{ $tgn->nilai }}</td>
            <td>
                <form action="{{ route('orangtua.destroy',$tgn->id ) }}" method="POST">
                        {{-- <a href="#"> <i class="fa fa-eye" style="font-size:24px"></i> </a> --}}
                    @can('ortu-edit')
                        <a class="btn btn-warning" href="{{ URL::to('admin/ubahtanggungan/' . $tgn->id ) }}"> Ubah </a>
                        {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('ortu-delete')
                        <a data-id="{{ $tgn->id }}" id="btndelete" class="btn btn-danger" href="#"> Hapus </a>
                        {{-- <i class="fa fa-trash-o" style="font-size:24px"> </i> --}}
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
        </table>

        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
                        window.location.replace("http://127.0.0.1:8000/admin/hapustanggungan/" + id );
                    } 
                });
            });

        });
    </script>
@stop