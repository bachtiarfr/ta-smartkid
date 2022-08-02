@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .nav-link.dropdown-toggle::before {
            content: "Logout" !important;
        }
    </style>
<script src="{{ ('js/main.js') }}"></script>
<style>
    .sudahAcc {
        background: red;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                                    <td> Nama Siswa </td>
                                    <td> C1 </td>
                                    <td> C2 </td>
                                    <td> C3 </td>
                                    <td> C4 </td>
                                    <td> C5 </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaian as $pnl)
                                    <tr>
                                        <td> {{ $pnl->nama_depan . ' ' . $pnl->nama_belakang }} </td>
                                        <td> {{ $pnl->c1 }} </td>
                                        <td> {{ $pnl->c2 }} </td>
                                        <td> {{ $pnl->c3 }} </td>
                                        <td> {{ $pnl->c4 }} </td>
                                        <td> {{ $pnl->c5 }} </td>
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
                                    <td> Nama Siswa </td>
                                    <td> C1 </td>
                                    <td> C2 </td>
                                    <td> C3 </td>
                                    <td> C4 </td>
                                    <td> C5 </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataNormalisasi as $n)
                                    <tr>
                                        <td> {{ $n["nama"] }} </td>
                                        <td> {{ $n["r1"] }} </td>
                                        <td> {{ $n["r2"] }} </td>
                                        <td> {{ $n["r3"] }} </td>
                                        <td> {{ $n["r4"] }} </td>
                                        <td> {{ $n["r5"] }} </td>
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
                    Perkalian Bobot dan Hasil 
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        Filter berdasarkan periode:
                        <select class="form-select mb-5" id="periode" aria-label="Default select example">
                            <option value="all">Lihat semua</option>
                            @foreach ($periode as $p)
                                <option value="{{ $p }}">{{ $p }}</option>
                            @endforeach
                        </select>
                        <table id="tblhasil" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <td> NISN </td>
                                    <td> Nama Siswa </td>
                                    <td> Kelas </td>
                                    <td> Score </td>
                                    <td> Keterangan </td>
                                    <td> Periode </td>
                                    <td> Berkas </td>
                                    @if (Auth::user()->role_id == 1)
                                        <td> Aksi </td>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="v-content">
                                @foreach ($dataPerangkingan as $data)
                                <tr class="item-list" data-value="{{ $data["w"] }}">
                                    <td> {{ $data["nisn"] }} </td>
                                    <td> {{ $data["nama"] }} </td>
                                    <td> {{ $data["kelas"] }} </td>
                                    <td> {{ $data["w"] }} </td>
                                    <td class="hasil"> Rekomendasi </td>
                                    <td class="periodePenerimaan"> {{ $data["periode"] }} </td>
                                    <td> 
                                        <div class="berkasPrestasi">
                                            <a target="_blank" href="{{ url('/pdf/'. $data["berkas_prestasi"] )}}">{{ $data["berkas_prestasi"] }}</a>
                                        </div>
                                        <div class="berkasBukti">
                                            <a target="_blank" href="{{ url('/pdf/'. $data["berkas_surat"] )}}">{{ $data["berkas_surat"] }}</a>
                                        </div>
                                    </td>
                                    @if (Auth::user()->role_id == 1)
                                        <td> 
                                            @if ($data["status"] == 1)
                                            <button class="btn btn-info sudahAcc" data-penilaian-id="{{ $data['penilaian_id'] }}" disabled>sudah diacc</button> 
                                                @else
                                                <button class="btn btn-info btnAcc" data-penilaian-id="{{ $data['penilaian_id'] }}">acc</button> 
                                            @endif
                                        </td>
                                    @endif
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

@stop
@section('js')
    <script>
        $(function () {

            var app = {
                tampil: function(){
                    let periode = $(this).val();
                    console.log(periode);
                    $('td.periodePenerimaan:not(:contains("' + periode + '"))').parent().hide();        
                    $('td.periodePenerimaan:contains("' + periode + '")').parent().show();
    
                    if (periode == 'all') {
                        $('td:contains("Rekomendasi")').parent().show();
                    }
    
                }
            }
            $(document).on("change", "#periode", app.tampil)

            $('table').DataTable();
            // reordering table (highest W to lower)
            var div = $('#v-content');
            var listitems = $(".item-list").get();
            listitems.sort(function (a, b) {
                return (+$(a).attr('data-value') > +$(b).attr('data-value')) ?
                -1 : (+$(a).attr('data-value') < +$(b).attr('data-value')) ? 
                1 : 0;
            })
            $.each(listitems, function (idx, itm) { 
                div.append(itm);
            });
            
            $('#v-content tr:nth-child(n+11) .hasil').each(function() {
                $(this).text("Tidak")
            });

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

                            
                            //array push
                            r.push({
                                "c1" : rc11,
                                "c2" : rc12,
                                "c3" : rc13,
                                "c4" : rc14,
                                "c5" : rc15,
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

                            
                            //array push
                            r.push({
                                "c1" : rc11,
                                "c2" : rc12,
                                "c3" : rc13,
                                "c4" : rc14,
                                "c5" : rc15,
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
                                </tr>
                            `;
                        } )

                        $('#tblhasil').append(tabel_hasil);
                    }
                });
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("click", ".btnAcc", function(){
                let dataSiswaID = $(this).attr("data-penilaian-id")
                //simpan ke tabel penilaian
                $.ajax({
                    type: "POST",
                    url: "/admin/acc-beasiswa",
                    data: {
                        dataSiswaID : dataSiswaID
                    },
                    success: function (response) {
                        swal({
                            title: "Berhasil",
                            text: response.message,
                            icon: "success",
                        });
                    }
                });
                $(this).attr("disabled", "disabled");
                $(this).html("sudah diacc")
                $(this).addClass("sudahAcc")
            })

        });
    </script>
@stop