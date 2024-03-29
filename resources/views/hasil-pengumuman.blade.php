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
    
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Beasiswa Smartkid</h2>
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
        <div class="row">
            <div class="col-md-12">
                Filter berdasarkan periode:
                <select class="form-select mb-5" id="periode" aria-label="Default select example">
                    <option value="all">Lihat semua</option>
                    @if (count($dataPerangkingan) > 0)
                    @foreach ($periode as $p)
                        <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                    @endif
                </select>
                <div class="card">
                    <div class="card-header alert-success">
                        Hasil pengumuman
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tblhasil" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>NISN</td>
                                        <td> Nama Siswa </td>
                                        <td> Score </td>
                                        <td> Periode </td>
                                        <td> Keterangan </td>
                                    </tr>
                                </thead>
                                <tbody id="v-hasil">
                                    @foreach ($dataPerangkingan as $data)
                                    <tr class="item-list" data-value="{{ $data["w"] }}">
                                        <td>{{ $data["nisn"] }}</td>
                                        <td> {{ $data["nama"] }} </td>
                                        <td> {{ $data["w"] }} </td>
                                        <td class="periodePenerimaan"> {{ $data["periode"] }} </td>
                                        <td class="hasil"> Rekomendasi </td>
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
    
@section('js')
@stop
<script>
    $(function () {
        $('table').DataTable();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var app = {
			tampil: function(){
				let periode = $(this).val();
                $('td.periodePenerimaan:not(:contains("' + periode + '"))').parent().hide();        
                $('td.periodePenerimaan:contains("' + periode + '")').parent().show();

                if (periode == 'all') {
                    $('td:contains("Rekomendasi")').parent().show();
                }

			}
		}
		$(document).on("change", "#periode", app.tampil)
        
        // reordering table (highest W to lower)
        var div = $('#v-hasil');
        var listitems = $(".item-list").get();
        listitems.sort(function (a, b) {
            return (+$(a).attr('data-value') > +$(b).attr('data-value')) ?
            -1 : (+$(a).attr('data-value') < +$(b).attr('data-value')) ? 
            1 : 0;
        })
        $.each(listitems, function (idx, itm) { 
            div.append(itm);
        });

        $('#v-hasil tr:nth-child(n+11) .hasil').each(function() {
            $(this).text("Tidak")
        });

    });
</script>
</body>

</html>