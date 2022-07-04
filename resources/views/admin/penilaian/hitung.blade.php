@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert-success">
                    Perhitungan 
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <td> ID </td>
                                    <td> Nama Siswa </td>
                                    <td> C1 </td>
                                    <td> C2 </td>
                                    <td> C3 </td>
                                    <td> C4 </td>
                                    <td> C6 </td>
                                    <td> C7 </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaian as $pnl)
                                    <tr>
                                        <td> {{ $pnl->id }} </td>
                                        <td> {{ $pnl->name }} </td>
                                        <td> {{ $pnl->c1 }} </td>
                                        <td> {{ $pnl->c2 }} </td>
                                        <td> {{ $pnl->c3 }} </td>
                                        <td> {{ $pnl->c4 }} </td>
                                        <td> {{ $pnl->c5 }} </td>
                                        <td> {{ $pnl->c6 }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    Proses Normalisasi 
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tblnormalisasi" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <td> C1 </td>
                                    <td> C2 </td>
                                    <td> C3 </td>
                                    <td> C4 </td>
                                    <td> C6 </td>
                                    <td> C7 </td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
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
                    Perkalian Bobot dan Hasil 
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tblhasil" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <td> V1 </td>
                                    <td> V2 </td>
                                    <td> V3 </td>
                                    <td> V4 </td>
                                    <td> V6 </td>
                                    <td> V7 </td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div> 
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function () {

            normalisasi();

            let r = [];
            let urut = 0;
            let isi_tabel_normalisasi = '';

            function normalisasi() {
                $.ajax({
                    type: "GET",
                    url: "/admin/getpenilaian",
                    dataType: "JSON",
                    success: function (res) {

                        for (let i = 0; i < res.length; i++) {
                             // Nilai terendah C1 / nilai sekarang
                            const rc11 = Math.min( ...res.map( r => r.c1 )) / res[i]["c1"]  ;
                            // console.log( rc11 );

                            // Nilai terendah C2 / nilai sekarang
                            const rc12 = Math.min( ...res.map( r => r.c2 )) / res[i]["c2"] ;
                            // console.log( rc12 );

                            // Nilai terendah C3 / nilai sekarang
                            const rc13 = Math.min( ...res.map( r => r.c3 )) / res[i]["c3"] ;
                            // console.log( rc13 );

                            // Nilai terendah C4 / nilai sekarang
                            const rc14 = Math.min( ...res.map( r => r.c4 )) / res[i]["c4"] ;
                            // console.log( rc14 );

                            // Nilai terendah C5 / nilai sekarang
                            const rc15 = Math.max( ...res.map( r => r.c5 )) / res[i]["c5"] ;
                            // console.log( rc15 );

                            // Nilai terendah C6 / nilai sekarang
                            const rc16 = Math.min( ...res.map( r => r.c6 )) / res[i]["c6"] ;
                            // console.log( rc16 ); 
                            
                            //array push
                            r.push({
                                "c1" : rc11,
                                "c2" : rc12,
                                "c3" : rc13,
                                "c4" : rc14,
                                "c5" : rc15,
                                "c6" : rc16
                            })
                        }
                         
                        r.map( rn => {
                            isi_tabel_normalisasi += `
                                <tr>
                                    <td> ${rn.c1} </td>
                                    <td> ${rn.c2} </td>
                                    <td> ${rn.c3} </td>
                                    <td> ${rn.c4} </td>
                                    <td> ${rn.c5} </td>
                                    <td> ${rn.c6} </td>
                                </tr>
                            `;
                        } )

                        $('#tblnormalisasi').append(isi_tabel_normalisasi);

                    }

                });
            }

            //hasil
            let v = [];
            let tabel_hasil = '';

            hasil();

            function hasil() {
                $.ajax({
                type: "GET",
                url: "/admin/getpenilaian",
                dataType: "JSON",
                success: function (res) {

                    for (let i = 0; i < res.length; i++) {
                             // Nilai terendah C1 penghasilan / nilai sekarang
                            const rc11 = Math.min( ...res.map( r => r.c1 )) / res[i]["c1"] * 0.25  ;
                            console.log( rc11 );

                            // Nilai terendah C2  kondisi rumah / nilai sekarang
                            const rc12 = Math.min( ...res.map( r => r.c2 )) / res[i]["c2"] * 0.20 ;
                            console.log( rc12 );

                            // Nilai terendah C3 kepemilikan asset / nilai sekarang
                            const rc13 = Math.min( ...res.map( r => r.c3 )) / res[i]["c3"] * 0.15 ;
                            console.log( rc13 );

                            // Nilai terendah C4 teernak / nilai sekarang
                            const rc14 = Math.min( ...res.map( r => r.c4 )) / res[i]["c4"]  ;
                            console.log( rc14 );

                            // Nilai terendah C5 tanggungan / nilai sekarang
                            const rc15 = Math.max( ...res.map( r => r.c5 )) / res[i]["c5"] * 0.30 ;
                            console.log( rc15 );

                            // Nilai terendah C6 asuransi / nilai sekarang
                            const rc16 = Math.min( ...res.map( r => r.c6 )) / res[i]["c6"] * 0.10 ;
                            console.log( rc16 ); 
                            
                            //array push
                            r.push({
                                "c1" : rc11,
                                "c2" : rc12,
                                "c3" : rc13,
                                "c4" : rc14,
                                "c5" : rc15,
                                "c6" : rc16
                            })
                        }

                        v.map( rv => {
                            tabel_hasil += `
                                <tr>
                                    <td> ${rv.c1} </td>
                                    <td> ${rv.c2} </td>
                                    <td> ${rv.c3} </td>
                                    <td> ${rv.c4} </td>
                                    <td> ${rv.c5} </td>
                                    <td> ${rv.c6} </td>
                                </tr>
                            `;
                        } )

                        $('#tblhasil').append(tabel_hasil);
                    }
                });
            }

        });
    </script>
@stop