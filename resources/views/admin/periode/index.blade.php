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
        <th> Nama Beasiswa </th>
        <th> Semester </th>
        <th> Tahun </th>
        <th> Status </th>
        <th>Action</th>
    </tr>
    @foreach ($periode as $p)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $p->nama_beasiswa }}</td>
        <td>{{ $p->semester }}</td>
        <td>{{ $p->tahun }}</td>
        <td>{{ $p->status }}</td>
        <td>
            <form action="{{ route('periode.destroy',$p->id ) }}" method="POST">
                    {{-- <a href="#"> <i class="fa fa-eye" style="font-size:24px"></i> </a> --}}
                @can('ortu-edit')
                    <a class="btn btn-warning" href="{{ URL::to('admin/ubahperiode/' . $p->id ) }}"> Ubah </a>
                    {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                @endcan


                @csrf
                @method('DELETE')
                @can('ortu-delete')
                    <a class="btn btn-danger" href="{{ URL::to('admin/hapusperiode/' . $p->id ) }}"> Hapus </a>
                    {{-- <i class="fa fa-trash-o" style="font-size:24px"> </i> --}}
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
    </table>


    {!! $periode->links() !!}
    @stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop