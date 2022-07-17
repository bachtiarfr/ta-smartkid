<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SMARTKID - Aplikasi Beasiswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Beasiswa</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="{{ URL::to('/daftar-beasiswa') }}" class="dropdown-item active">Daftar Beasiswa</a>
                        <a href="{{ URL::to('/hasil-pengumuman') }}" class="dropdown-item">Hasil Pengumuman</a>
                    </div>
                </div>
                {{-- <a href="about.html" class="nav-item nav-link">Tentang</a> --}}
                <a href="/contact" class="nav-item nav-link">Kontak</a>
            </div>
            @if (Auth::check() > 0)
                <a href="/home" class="btn btn-primary btn-dashboard">Dashboard</a>
                @else
                <a href="{{ URL::to('/login') }}" class="btn btn-primary btn-login">Masuk</i></a>
            @endif
        </div>
    </nav>
    <!-- Navbar End -->
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/1.jpg" alt="" style="height: 685px; object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7); height: 685px !important;">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Beasiswa Smartkid</h5>
                                <h1 class="display-3 text-white animated slideInDown">Portal pendaftaran beasiswa</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Ditujukan untuk siswa berprestasi dalam melanjutkan pendidikan nya dijalur beasiswa.</p>
                                <a href="/daftar-beasiswa" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/2.jpg" alt="" style="height: 685px; object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7); height: 685px !important;">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Beasiswa Smartkid</h5>
                                <h1 class="display-3 text-white animated slideInDown">Portal pendaftaran beasiswa</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Ditujukan untuk siswa berprestasi dalam melanjutkan pendidikan nya dijalur beasiswa.</p>
                                <a href="/daftar-beasiswa" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/3.jpg" alt="" style="height: 685px; object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7); height: 685px !important;">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Beasiswa Smartkid</h5>
                                <h1 class="display-3 text-white animated slideInDown">Portal pendaftaran beasiswa</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Ditujukan untuk siswa berprestasi dalam melanjutkan pendidikan nya dijalur beasiswa.</p>
                                <a href="/daftar-beasiswa" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
    <div class="container">
        <form action="{{ URL::to('/daftar-beasiswa/post') }}" id="formBeasiswa" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header alert-success">
                        Data orang tua
                        </div>
                        <div class="card-body">
                        <div class="row">

                            <div class="col-md-3 mb-2">
                                <label> Nama Orang Tua / Wali (Depan) </label>
                                <input type="text" name="nama_orangtua_depan" id="nama_orangtua_depan" class="form-control">
                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label> Nama Orang Tua / Wali (Belakang) </label>
                                <input type="text" name="nama_orangtua_belakang" id="nama_orangtua_belakang" class="form-control">
                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label> Nomer Induk Kependudukan </label>
                                <input type="text" name="nik" id="nik" class="form-control" required>
                            </div>
 
                            <div class="col-md-3 mb-2">
                                <label> Status </label>
                                <select name="status" id="status" class="form-control">
                                    <option selected value="ayah" data-id="1"> Ayah </option>
                                    <option value="ibu"> Ibu </option>
                                    <option value="wali"> Wali Murid </option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label> Pendidikan Terakhir </label>
                                <select name="pendidikan" id="pendidikan" class="form-control">
                                    <option value="sd"> Sekolah Dasar </option>
                                    <option value="smp"> Sekolah Menengah Pertama </option>
                                    <option selected value="sma/k"> Sekolah Menengah Atas/Kejuruan </option>
                                    <option value="s1"> Sarjanah Strata 1 </option>
                                    <option value="s2"> Sarjanah Strata 2 </option>
                                    <option value="s3"> Sarjanah Strata 3 </option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label> Pekerjaan Orang Tua</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <Label> Penghasilan Orangtua </Label>
                                <select id="penghasilan_id" name="penghasilan_id" class="form-control">
                                    @foreach ( $penghasilan as $hsl )
                                        <option data-id="{{ $hsl->bobot }}" value="{{ $hsl->id  }}"> {{ $hsl->penghasilan }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <Label> Jumlah Tanggungan Orangtua </Label>
                                <select id="tanggungan_id" name="tanggungan_id" class="form-control">
                                    @foreach ( $tanggungan as $tgn )
                                        <option data-id="{{ $tgn->nilai }}" name="{{ $tgn->nilai }}" value="{{ $tgn->id  }}"> {{ $tgn->jumlah }} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 mb-2">
                                <Label> Upload Berkas </Label>
                                <input type="file" name="berkas_surat" id="berkas_surat" accept="application/pdf" >
                            </div>    
                            
                        </div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header alert-success">
                        Data diri siswa
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <Label> Nomor Induk Siswa Nasional </Label>
                                <input type="text" name="nisn" id="nisn" class="form-control" placeholder="nisn">
                            </div>
                            <div class="col-md-6 mb-2">
                                <Label> Nama Depan </Label>
                                <input type="text" id="nama_depan" name="nama_depan" class="form-control" placeholder="masukan nama">
                            </div>
                            <div class="col-md-6 mb-2">
                                <Label> Nama Belakang </Label>
                                <input type="text" id="nama_belakang" name="nama_belakang" class="form-control" placeholder="masukan nama">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label> Jenis Kelamin </label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="L"> Laki-Laki</option>
                                    <option value="P"> Perempuan </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label> Jurusan </label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option value="Teknik Kendaraan Ringan"> Teknik Kendaraan Ringan </option>
                                    <option value="Teknik Permesinan"> Teknik Permesinan </option>
                                    <option value="Teknik Komputer Jaringan"> Teknik Komputer Jaringan </option>
                                    <option value="Teknik Kimia Industri"> Teknik Kimia Industri </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label> Kelas </label>
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value="X"> Kelas X </option>
                                    <option value="XI"> Kelas XI </option>
                                    <option value="XII"> Kelas XII </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group mb-2">
                                    <Label> Prestasi </Label>
                                    <button id="btnAddPrestasi" class="btn btn-success" style="padding: 5px 10px; font-size: 10px; margin-left: 10px;"> Tambah prestasi </button>
                                </div>
                                <div id="group_prestasi">
                                    <div class="col-md-9 form-inline p-0" id="dv_prestasi">
                                        <div class="form-group d-flex mb-3">
                                            <input type="text" name="prestasi" id="prestasi" class="form-control prestasi">
                                            <div class="btn btn-danger ml-2 btnDelete">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <Label> Upload Berkas Prestasi </Label>
                                <input type="file" name="berkas_prestasi" id="berkas_prestasi" accept="application/pdf" >
                            </div>    
                            
                            <div class="col-md-3">
                                <Label> Jenis Asuransi Kesehatan </Label>
                                <select id="asuransi_id" name="asuransi_id" class="form-control">
                                    @foreach ( $asuransi as $asr )
                                        <option data-id="{{ $asr->nilai }}" value="{{ $asr->id }}"> {{ $asr->nama }} </option>
                                    @endforeach
                                </select>
                            </div>    
                        </div> 
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header alert-success">
                        Asset
                        </div>
                        <div class="card-body" id="dvasset">
                        <div id="row_rumah" class="row">
                            @foreach ( $rumah as $rmh )
                                <div class="col-md-4 mb-2">
                                    <label>{{ $rmh->keterangan }}</label>
                                    <select name="rumah_id" id="rumah_id" class="form-control">
                                        @foreach ( $rmh->rumahdetail as $rdet)
                                            <option value="{{ $rmh->id }}" data-id="{{ $rdet->value }}" name="{{ $rdet->value }}"> {{ $rdet->key }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <div id="row_asset" class="row">
                            @foreach ( $assets as $ast )
                                <div class="col-md-4 mb-2">
                                    <label>{{ $ast->nama }}</label>
                                    <select name="assets_id" id="assets_id" class="form-control">
                                        @foreach ( $ast->assetsdetail as $asdet)
                                            <option value="{{ $ast->id }}" name="{{ $asdet->value }}" data-id="{{ $asdet->value }}"> {{ $asdet->key }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        
            {{-- <a href="#" class="btnSimpan">Simpan</a> --}}
            <input type="submit" value="simpan" class="btn btn-primary btnSimpan" name="simpan">
        </form>
    </div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a><br><br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ ('js/main.js') }}"></script>
</body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
  </button>
  
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        ...
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>

<script>
  $(function () {
      console.log('beasiswa daftar');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btnSimpan').click(function (e) { 
        e.preventDefault();
        
        let berkas_prestasi = $("#berkas_prestasi")[0].files[0];
        let berkas_surat = $("#berkas_surat")[0].files[0];


        //profil siswa
        let siswa_id = $('#siswa_id').val();
        let penghasilan_id = $('#penghasilan_id').val();
        let tanggungan_id = $('#tanggungan_id').val();
        let asuransi_id = $('#asuransi_id').val();
        let nama_depan = $("#nama_depan").val();
        let nama_belakang = $("#nama_belakang").val();
        let nisn = $("#nisn").val();
        let jurusan = $('#jurusan option:selected').val();
        let kelas = $('#kelas option:selected').val();
        let jk = $('#jk option:selected').val();
        
        let nama_depan_siswa = $("#nama_depan").val();
        let nama_depan_belakang = $("#nama_belakang").val();
        let status = $('#status option:selected').val();
        let nik = $("#nik").val();
        let pendidikan = $('#pendidikan option:selected').val();
        let pekerjaan = $("#pekerjaan").val();

        let nama_orangtua_depan = $("#nama_orangtua_depan").val();
        let nama_orangtua_belakang = $("#nama_orangtua_belakang").val();

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
        let c4 = tanggungan_bobot.selectedOptions[0].getAttribute("data-id");
        let c5 = asuransi_bobot.selectedOptions[0].getAttribute("data-id");

        let count_row_rumah = $('#dvasset > #row_rumah').find('option:selected').each(function () {
            // console.log(this.value);
            console.log("c2 :", $(this).data("id") );
            c2 += $(this).data("id") ;
        });

        c2 = parseFloat( c2 / count_row_rumah.length ).toFixed(2) ;

        //get data asset - row_asset

        let c3 = 0;
        let jml_c3 = 0;
       
        let count_row_asset = $('#dvasset > #row_asset').find('option:selected').each(function () {
            // console.log(this.value);
            console.log("c3", $(this).data("id") );
            c3 += $(this).data("id");
        });

        c3 = parseFloat( c3 / count_row_asset.length ).toFixed(2) ;

        console.log("c1 :", c1);
        console.log("c2 :", c2);
        console.log("c3 :", c3);
        console.log("c4 :", c4);
        console.log("c5 :", c5);
        console.log("berkas surat:", berkas_surat);
        console.log("berkas prestasi:", berkas_prestasi);

        let formData = new FormData();
        formData.append("berkas_prestasi", berkas_prestasi)
        formData.append("berkas_surat", berkas_surat)
        formData.append("siswa_id", siswa_id)
        formData.append("penghasilan_id", penghasilan_id)
        formData.append("tanggungan_id", tanggungan_id)
        formData.append("asuransi_id", asuransi_id)
        formData.append("status", status)

        let group_prestasi = $("#group_prestasi .prestasi");
        var prestasis = [];
        group_prestasi.each(function(){
            prestasis.push($(this).val()); 
            formData.append("prestasis", prestasis)
        });
        
        formData.append("nik", nik)
        formData.append("nisn", nisn)
        formData.append("pekerjaan", pekerjaan)
        formData.append("jurusan", jurusan)
        formData.append("kelas", kelas)
        formData.append("pendidikan", pendidikan)
        formData.append("jk", jk)
        formData.append("asset_value", assets_data_id)
        formData.append("asset_id", assets_val)
        formData.append("rumah_id", rumah_val)
        formData.append("rumah_data", rumah_data_id)
        formData.append("nama_depan", nama_depan)
        formData.append("nama_belakang", nama_belakang)
        formData.append("nama_orangtua_depan", nama_orangtua_depan)
        formData.append("nama_orangtua_belakang", nama_orangtua_belakang)
        formData.append("c1", c1)
        formData.append("c2", c2)
        formData.append("c3", c3)
        formData.append("c4", c4)
        formData.append("c5", c5)
        //simpan ke tabel penilaian
        $.ajax({
            type: "POST",
            url: "/daftar-beasiswa/post",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                swal({
                    title: "Berhasil",
                    text: response.message,
                    icon: "success",
                });
            }
        });
        
    });
  });
</script>
</html>