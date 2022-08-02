@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="padding">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Data Assets</strong>
                        <small>yang dimiliki</small>
                    </div>

                    @foreach ($assets_id as $as)
                        <input type="text" name="assets_id" value="{{ $as }}" id="assets_id" class="form-control">
                    @endforeach

                    @foreach ($nama as $nam)
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="ccmonth"> Nama Assets </label>
                                    <input type="text" name="nama" value="{{ $nam }}" id="nama" class="form-control">
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $no = 1;  }}

                    @foreach ($assets as $ast)
                        <div class="row" id="dvbobot">
                            <div class="form-group col-sm-4">
                                <label> Keterangan </label>
                                <input type="text" name="key" value="{{ $ast->key }}" id="key" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label> Bobot/Nilai </label>
                                <input type="text" name="value" value="{{ $ast->value }}" id="value" class="form-control">
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
                let assets_id   = $('#assets_id').val();

                let dvbobot     = $("#dvbobot");
                let inputan     = $("#dvbobot input[type=text]");
                console.log("length :", dvbobot.length);

                for (let i = 0; i < inputan.length - 1; i += 2 ) {
                    // const element = array[i];
                    isi_det.push(
                        { "key" : inputan[i].value , "value" : inputan[i + 1].value }
                    );
                }
                

                //1. ubah ke tabel assets

                $.ajax({
                    type: "GET",
                    url: "/admin/ubahassets/" + assets_id ,
                    data: {
                        "nama" : nama
                    },
                    success: function ( res ) {
                        //2. simpan ke tabel assets detail
                        simpan_assets_detail( res );
                        swal({
                            title: "Berhasil",
                            text: res,
                            icon: "success",
                        });
                    }
                });
            });

            // fungsi ubah data assets detail berupa array
            function simpan_assets_detail( id ) {
                $.ajax({
                    type: "GET",
                    url: "/admin/ubahassetsdetail/" + id ,
                    data: {
                        isi_det
                    },
                    success: function ( res ) {
                        console.log(res);
                        swal({
                            title: "Berhasil",
                            text: res,
                            icon: "success",
                        }).then(function() {
                            window.history.back();
                            location.reload(); 
                        });
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