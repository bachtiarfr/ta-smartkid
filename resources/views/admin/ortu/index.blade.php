@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
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
        <th> NIK </th>
        <th> NAMA LENGKAP </th>
        <th> STATUS </th>
        <th> PENDIDIKAN </th>
        <th> PEKERJAAN </th>
        <th>Action</th>
    </tr>
    @foreach ($ortu as $ort)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $ort->nik }}</td>
        <td>{{ $ort->nama_depan . " " . $ort->nama_belakang }}</td>
        <td>{{ $ort->status }}</td> 
        <td>{{ $ort->pendidikan }}</td>
        <td>{{ $ort->pekerjaan }}</td>
        <td>
            <form action="{{ route('orangtua.destroy',$ort->id ) }}" method="POST">
                    {{-- <a href="#"> <i class="fa fa-eye" style="font-size:24px"></i> </a> --}}
                @can('ortu-edit')
                    <a class="btn btn-warning" href="{{ URL::to('admin/ubahortu/' . $ort->id ) }}"> Ubah </a>
                    {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                @endcan


                @csrf
                @method('DELETE')
                @can('ortu-delete')
                    <a data-id="{{ $ort->id }}" id="btndelete" class="btn btn-danger" href="#"> Hapus </a>
                    {{-- <i class="fa fa-trash-o" style="font-size:24px"> </i> --}}
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
    </table>


    {!! $ortu->links() !!}
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
                        window.location.replace("http://127.0.0.1:8000/admin/orangtua/" + id );
                    }
                });
                
            });
        });
    </script>
@stop