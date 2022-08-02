@extends('adminlte::page')

@section('title', 'Data Kriteria Penghasilan')

@section('content_header')
    <h1>Data Kriteria Penghasilan</h1>
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
            <th> List Penghasilan </th>
            <th> Bobot / Nilai </th>
            @if (Auth::user()->role_id == 1)
            <th>Action</th>
            @endif
        </tr>
        @foreach ($penghasilan as $p)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $p->penghasilan }}</td>
            <td>{{ $p->bobot }}</td>
            @if (Auth::user()->role_id == 1)
            <td>
                <form action="{{ route('orangtua.destroy',$p->id ) }}" method="POST">
                    {{-- <a href="#"> <i class="fa fa-eye" style="font-size:24px"></i> </a> --}}
                    <a class="btn btn-warning" href="{{ URL::to('admin/ubahpenghasilan/' . $p->id ) }}"> Ubah </a>
                    {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}

                    @csrf
                    @method('DELETE')
                        <a data-id="{{ $p->id }}" id="btndelete" class="btn btn-danger" href="#"> <i class="fa fa-trash-o" style="font-size:24px"> </i> </a>
                        {{-- <i class="fa fa-trash-o" style="font-size:24px"> </i> --}}
                </form>
            </td>
            @endif
        </tr>
        @endforeach
        </table>

        {{-- {!! $penghasilan->links() !!} --}}
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
                        window.location.replace("/admin/hapuspenghasilan/" + id );
                    } 
                });
            });

        });
    </script>
@stop