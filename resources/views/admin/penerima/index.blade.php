@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Print PDF
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="/admin/print-data-beasiswa/genap">Print Periode Semester Genap</a>
          <a class="dropdown-item" href="/admin/print-data-beasiswa/ganjil">Print Periode Semester Ganjil</a>
        </div>
    </div>
    Filter berdasarkan periode:
    <select class="form-select mb-5" id="periode" aria-label="Default select example">
        <option value="all">Lihat semua</option>
        @if (count($periode) > 0)
        @foreach ($periode as $p)
            <option value="{{ $p }}">{{ $p }}</option>
        @endforeach
        @endif
    </select>
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
                Hasil Pengumuman
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="tblhasil" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <td> NISN </td>
                                <td> Nama Siswa </td>
                                <td> Kelas </td>
                                <td> Score </td>
                                <td> Periode </td>
                            </tr>
                        </thead>
                        <tbody id="v-hasil">
                            @if (count($periode) > 0)
                            @foreach ($dataPerangkingan as $data)
                            <tr class="item-list" data-value="{{ $data["w"] }}">
                                <td> {{ $data["nisn"] }} </td>
                                <td> {{ $data["nama"] }} </td>
                                <td> {{ $data["kelas"] }} </td>
                                <td> {{ $data["w"] }} </td>
                                <td class="periodePenerimaan"> {{ $data["periode"] }} </td>
                            </tr>
                            @endforeach
                            @endif
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

            var app = {
                tampil: function(){
                    let periode = $(this).val();
                    $('td.periodePenerimaan:not(:contains("' + periode + '"))').parent().hide();        
                    $('td.periodePenerimaan:contains("' + periode + '")').parent().show();
    
                    if (periode == 'all') {
                        $('td:contains("/")').parent().show();
                    }
    
                }
            }
            $(document).on("change", "#periode", app.tampil)

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
                let dataSiswaID = $(this).attr("data-siswa-id")
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