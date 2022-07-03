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
        <th> Nama Siswa </th>
        <th> NISN </th>
        <th> Kelamin </th>
        <th> Kelas </th>
        <th> Jurusan </th>
        <th> Nama Orang Tua </th>
        <th> Penghasilan </th>
        <th> Beasiswa </th>
        <th> Semester </th>
        <th> Tahun </th>
        <th>Action</th>
    </tr>
    @foreach ($pendaftar as $p)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->nisn }}</td>
        <td>{{ $p->jk }}</td>
        <td>{{ $p->kelas }}</td>
        <td>{{ $p->jurusan }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->penghasilan }}</td>
        <td>{{ $p->nama_beasiswa }}</td>
        <td>{{ $p->semester }}</td>
        <td>{{ $p->tahun }}</td>
        {{-- @foreach ($ortu as $o)
        <td>{{ $o->name }}</td>
        <td>{{ $o->penghasilan }}</td>
        @endforeach

        @foreach ($periode as $p)
        <td>{{ $p->nama_beasiswa }}</td>
        <td>{{ $p->semester }}</td>
        <td>{{ $p->tahun }}</td>
        @endforeach

        @foreach ($pendaftar as $pn)        --}}
        <td>
            <form action="{{ route('pendaftar.destroy',$p->id ) }}" method="POST">
                @can('ortu-edit')
                    <a class="btn btn-warning"href="{{ URL::to('admin/ubahpendaftar/' . $p->id ) }}"> Ubah </a>
                    {{-- <i class="fa fa-pencil" style="font-size:24px"></i> --}}
                @endcan


                @csrf
                @method('DELETE')
                @can('ortu-delete')
                    <a class="btn btn-danger" href="{{ URL::to('admin/hapuspendaftar/' . $p->id ) }}"> Hapus </a>
                    {{-- <i class="fa fa-trash-o" style="font-size:24px"> </i> --}}
                @endcan
            </form>
        </td>
        @endforeach
    </tr>
    
    </table>


    {!! $pendaftar->links() !!}
    @stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop