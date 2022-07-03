@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
{{-- <form action="{{ URL::to('admin/penilaian') }}" method="post"> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert-success">
                   Profil Siswa
                </div>
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-3">
                        <Label> Nama Siswa </Label>
                        <select id="siswa_id" name="siswa_id" class="form-control">
                            @foreach ( $siswa as $sw )
                            <option value="{{ $sw->id  }}"> {{ $sw->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <Label> Penghasilan Orangtua </Label>
                        <select id="penghasilan_id" name="penghasilan_id" class="form-control">
                            @foreach ( $penghasilan as $hsl )
                                <option data-id="{{ $hsl->bobot }}" value="{{ $hsl->id  }}"> {{ $hsl->penghasilan }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <Label> Jumlah Tanggungan Orangtua </Label>
                        <select id="tanggungan_id" name="tanggungan_id" class="form-control">
                            @foreach ( $tanggungan as $tgn )
                                <option data-id="{{ $tgn->nilai }}" value="{{ $tgn->id  }}"> {{ $tgn->jumlah }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <Label> Jenis Asuransi Kesehatan </Label>
                        <select id="asuransi_id" name="asuransi_id" class="form-control">
                            @foreach ( $asuransi as $asr )
                                <option data-id="{{ $asr->nilai }}" value="{{ $asr->id  }}"> {{ $asr->nama }} </option>
                            @endforeach
                        </select>
                    </div>    
                   </div> 
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert-success">
                  Asset
                </div>
                <div class="card-body" id="dvasset">
                  <div id="row_rumah" class="row">
                    @foreach ( $rumah as $rmh )
                        <div class="col-md-3">
                            <label>{{ $rmh->keterangan }}</label>
                            <select name="rumah_id" id="rumah_id" class="form-control">
                                @foreach ( $rmh->rumahdetail as $rdet)
                                    <option value="{{ $rmh->id }}" data-id="{{ $rdet->value }}"> {{ $rdet->key }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                  </div>
                  <div id="row_asset" class="row">
                    @foreach ( $assets as $ast )
                        <div class="col-md-3">
                            <label>{{ $ast->nama }}</label>
                            <select name="assets_id" id="assets_id" class="form-control">
                                @foreach ( $ast->assetsdetail as $asdet)
                                    <option value="{{ $ast->id }}" data-id="{{ $asdet->value }}"> {{ $asdet->key }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert-success">
                  Hewan Ternak
                </div>
                <div class="card-body" id="dvternak">
                  <div id="row_ternak" class="row">
                    @foreach ( $ternak as $trk )
                        <div class="col-md-3">
                            <label>{{ $trk->nama }}</label>
                            <select name="ternak_id" id="ternak_id" class="form-control">
                                @foreach ( $trk->ternakdetail as $tdet)
                                    <option value="{{ $trk->id }}" data-id="{{ $tdet->value }}"> {{ $tdet->key }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                  </div>
                </div>
              </div>
        </div>
    </div>

    <input type="submit" value="simpan" class="btn btn-primary" name="simpan" id="btnsimpan">
{{-- </form> --}}
@stop

@section('css')

@stop

@section('js')
  <script>
      $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btnsimpan').click(function (e) { 
            e.preventDefault();

            //profil siswa
            let siswa_id = $('#siswa_id').val();
            let penghasilan_id = $('#penghasilan_id').val();
            let tanggungan_id = $('#tanggungan_id').val();
            let asuransi_id = $('#asuransi_id').val();

            //membaca selectedOptions penghasilan, tanggungan, asuransi untuk c1,c5,c6
            const gaji_bobot = document.querySelector('#penghasilan_id');
            const tanggungan_bobot = document.querySelector('#tanggungan_id');
            const asuransi_bobot = document.querySelector('#asuransi_id');

            // variable rumah
            let rumah_val = $('#rumah_id option:selected').val();
            let rumah_data_id = $('#rumah_id option:selected').data('id');
            //variable asset
            let assets_val = $('#assets_id option:selected').val();
            let assets_data_id = $('#assets_id option:selected').data('id');

            //variable
            let c1 = gaji_bobot.selectedOptions[0].getAttribute("data-id");
            let c2 = 0;
            let jml_c2 = 0;
            let c5 = tanggungan_bobot.selectedOptions[0].getAttribute("data-id");
            let c6 = asuransi_bobot.selectedOptions[0].getAttribute("data-id");

            let count_row_rumah = $('#dvasset > #row_rumah').find('option:selected').each(function () {
                c2 += $(this).data("id") ;
            });

            c2 = parseFloat( c2 / count_row_rumah.length ).toFixed(2) ;

            //get data asset - row_asset
            let c3 = 0;
            let jml_c3 = 0;
            let count_row_asset = $('#dvasset > #row_asset').find('option:selected').each(function () {
                c3 += $(this).data("id");
            });

            c3 = parseFloat( c3 / count_row_asset.length ).toFixed(2) ;

            //get data ternak - row_ternak 
            let c4 = 0;
            let jml_c4 = 0;
            let count_row_ternak = $('#dvternak > #row_ternak').find('option:selected').each(function () {
                c4 += $(this).data("id");
            });

            c4 = parseFloat( c4 / count_row_ternak.length ).toFixed(2) ;

            let rumah_data = $(this).data("id");

            
            let data = {
                "gaji" : c1,
                "luas rumah" : c2,
                "aset" : c3,
                "hewat ternak" : c4,
                "tanggungan orang tua" : c5,
                "asuransi" : c6
            }
            console.log('data :', data);

            //simpan ke tabel penilaian
            // $.ajax({
            //     type: "POST",
            //     url: "/admin/penilaian",
            //     data: {
            //         siswa_id : siswa_id,
            //         penghasilan_id : penghasilan_id,
            //         tanggungan_id : tanggungan_id,
            //         asuransi_id : asuransi_id,
            //         c1 : c1,
            //         c2 : c2,
            //         c3 : c3,
            //         c5 : c5,
            //         c6 : c6
            //     },
            //     success: function (response) {
            //         console.log( response );
            //     }
            // });
            
        });
      });
  </script>
@stop