@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Data Ternak</strong>
                        <small>yang dipelihara</small>
                    </div>

                    @foreach ($ternak_id as $trk)
                        <input type="text" name="ternak_id" value="{{ $trk }}" id="ternak_id" class="form-control">
                    @endforeach

                    @foreach ($nama as $nam)
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="ccmonth"> Nama Ternak </label>
                                    <input type="text" name="nama" value="{{ $nam }}" id="nama" class="form-control">
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $no = 1;  }}

                    @foreach ($data as $dat)
                        <div class="row" id="dvbobot">
                            <div class="form-group col-sm-4">
                                <label> Keterangan </label>
                                <input type="text" name="key" value="{{ $dat->key }}" id="key" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label> Bobot/Nilai </label>
                                <input type="text" name="value" value="{{ $dat->value }}" id="value" class="form-control">
                            </div>

                            @if ( $no == 1 )
                                <div class="form-group col-sm-1" id="dvbutton">
                                    <label> &nbsp; </label>
                                    <br>
                                    <button id="btnplus" class="btn btn-sm btn-success" type="submit"> + </button>
                                </div>  
                            @endif

                            @php
                                $no++
                            @endphp
                        </div>
                    @endforeach

                    </div>
                    <div class="card-footer">
                        <button id="btnsimpan" class="btn btn-sm btn-success float-right" type="submit">
                            <i class="mdi mdi-gamepad-circle"></i> Simpan </button>
                        <button class="btn btn-sm btn-danger" type="reset">
                            <i class="mdi mdi-lock-reset"></i> Cancel </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
@stop

@section('js')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let isi_det = [];

            $('#btnsimpan').click(function (e) { 
                e.preventDefault();
                let nama        = $('#nama').val();
                let ternak_id   = $('#ternak_id').val();

                let inputan     = $("#dvbobot input[type=text]");
                

                for (let i = 0; i < inputan.length - 1; i += 2 ) {
                    // const element = array[i];
                    isi_det.push(
                        { "key" : inputan[i].value , "value" : inputan[i + 1].value }
                    );
                }
                

                //1. ubah ke tabel ternak

                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/admin/ubahternak/" + ternak_id ,
                    data: {
                        "nama" : nama
                    },
                    success: function ( res ) {
                        //2. simpan ke tabel ternak detail
                        simpan_ternak_detail( res );
                    }
                });
            });

            // fungsi simpan data ternak detail berupa array
            function simpan_ternak_detail( id ) {
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/admin/ubahternakdetail/" + id ,
                    data: {
                        isi_det
                    },
                    success: function ( res ) {
                        console.log(res);
                    }
                });
            }

            // ketika tombol plus di clik
            $('#btnplus').click(function (e) { 
                e.preventDefault();
                let isi_bobot = `
                         <div class="form-group col-sm-4">
                            <label> Keterangan </label>
                            <input type="text" name="key" id="key" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label> Bobot/Nilai </label>
                            <input type="text" name="value" id="value" class="form-control">
                        </div>
                        <div class="form-group col-sm-1">
                            <label> &nbsp; </label>
                            <br>
                            <button id="btnmin" class="btn btn-sm btn-danger" type="submit"> - </button>
                        </div>
                `;

                $(isi_bobot).insertAfter('#dvbutton');
            });

        });
    </script>
@stop