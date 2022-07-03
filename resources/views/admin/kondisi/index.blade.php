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
        <th> Nama Orang Tua </th>
        <th> Status Rumah </th>
        <th> Level Bangunan </th>
        <th> Berkas PBB </th>
        <th> Photo Rumah </th>
        <th>Action</th>
    </tr>
    @foreach ($kondisi as $kr)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $kr->name }}</td>
        <td>{{ $kr->status_rumah }}</td>
        <td>{{ $kr->level_bangunan }}</td>
        <td>
            <img style="width:150px; height:100px;" src="{{ asset('images/' . $kr->berkas_surat_pajak) }}">
        </td>
        <td>
            <img style="width:150px; height:100px;" src="{{ asset('images/' . $kr->photo) }}">
        </td>
        <td>
            <form action="{{ route('kondisi.destroy',$kr->id ) }}" method="POST">
                    {{-- <a href="#"> <i class="fa fa-eye" style="font-size:24px"></i> </a> --}}
                @can('ortu-edit')
                    <a class="btn btn-warning" href="{{ URL::to('admin/editkondisi/' . $kr->id ) }}"> Ubah </a>
                    {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                @endcan


                @csrf
                @method('DELETE')
                @can('ortu-delete')
                    <a class="btn btn-danger" href="{{ URL::to('admin/hapuskondisi/' . $kr->id ) }}"> Hapus </a>
                    {{-- <i class="fa fa-trash-o" style="font-size:24px"> </i> --}}
                    @endcan
            </form>
        </td>
    </tr>
    @endforeach
    </table>


    {!! $kondisi->links() !!}
    @stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop