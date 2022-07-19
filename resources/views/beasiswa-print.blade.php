<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SMARTKID - Aplikasi Beasiswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
        </div>
    </div>
    <!-- Spinner End -->

    <div class="container">
        <div class="row">
            <div class="header" style="text-align: center">
                <div class="kop-image">
                    <img src="{{ storage_path('app/public/smaja.png') }}" alt="">
                    <img src="{{ public_path("storage/smaja.png") }}" alt="">
                </div>
                <div class="main-text">
                    <p style="margin: 0">LEMBAGA PENDIDIKAN MA'ARIF NU KAB.MAGELANG</p>
                    <h1>SMK MA'ARIF KOTA MUNGKID</h1>
                    <p style="margin: 0">
                        TEKNIK PERMESINAN TERAKREDITASI A <BR>
                        TEKNIK KOMPUTER DAN JARINGAN TERAKREDITASI A <BR>
                        TEKNIK DAN BISNIS SEPEDA MOTOR <BR>
                        KIMIA INDUSTRI
                    </p>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tblhasil" style="border: 1px solid #000; border-collapse: collapse; margin: auto; margin-top: 60px">
                                <thead>
                                    <tr>
                                        <td style="border: 1px solid #000">NISN</td>
                                        <td style="border: 1px solid #000"> Nama Siswa </td>
                                        <td style="border: 1px solid #000"> Score </td>
                                        <td style="border: 1px solid #000"> Periode </td>
                                        <td style="border: 1px solid #000"> Keterangan </td>
                                    </tr>
                                </thead>
                                <tbody id="v-hasil">
                                    @foreach ($dataPerangkingan as $data)
                                    <tr class="item-list" data-value="{{ $data["w"] }}" style="border-bottom: 1px solid #000">
                                        <td style="border: 1px solid #000">{{ $data["nisn"] }}</td>
                                        <td style="border: 1px solid #000"> {{ $data["nama"] }} </td>
                                        <td style="border: 1px solid #000"> {{ $data["w"] }} </td>
                                        <td style="border: 1px solid #000"> {{ $data["periode"] }} </td>
                                        <td class="hasil" style="border: 1px solid #000"> Rekomendasi </td>
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
    
    <!-- Template Javascript -->
    <script src="{{ ('js/main.js') }}"></script>
@section('js')
@stop
<script>
    let isi = '';
    let no = 1;
    $(function () {
        $('table').DataTable();
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

        // kondisi jika diklik dengan jquery click
        $('#btnAddPrestasi').click(function (e) { 
            e.preventDefault();
            // $('#dv_prestasi').clone().insertAfter('#dv_prestasi');

            // ambil form bagian input prestasi kemudia dicloning
            isi = `
                <div class="col-md-9 form-inline p-0" id="dv_prestasi">
                    <div class="form-group d-flex mb-3">
                        <input type="text" name="prestasi${no}" id="prestasi${no}" class="form-control">
                        <div class="btn btn-danger ml-2 btnDelete">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>
            `;

            no++;

            $('#group_prestasi').append( isi );
        });

        $(document).on("click", ".btnDelete", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })

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
          let c4 = tanggungan_bobot.selectedOptions[0].getAttribute("data-id");
          let c5 = asuransi_bobot.selectedOptions[0].getAttribute("data-id");

          // 

          let count_row_rumah = $('#dvasset > #row_rumah').find('option:selected').each(function () {
              // console.log(this.value);
              console.log( $(this).data("id") );
              c2 += $(this).data("id") ;
          });

          c2 = parseFloat( c2 / count_row_rumah.length ).toFixed(2) ;

          //get data asset - row_asset

          let c3 = 0;
          let jml_c3 = 0;
         
          let count_row_asset = $('#dvasset > #row_asset').find('option:selected').each(function () {
              // console.log(this.value);
              console.log( $(this).data("id") );
              c3 += $(this).data("id");
          });

          c3 = parseFloat( c3 / count_row_asset.length ).toFixed(2) ;

          //simpan ke tabel penilaian
          $.ajax({
              type: "POST",
              url: "/admin/penilaian",
              data: {
                  siswa_id : siswa_id,
                  penghasilan_id : penghasilan_id,
                  tanggungan_id : tanggungan_id,
                  asuransi_id : asuransi_id,
                  asset_value : assets_data_id,
                  asset_id : assets_val,
                  rumah_id : rumah_val,
                  rumah_data : rumah_data_id,
                  c1 : c1,
                  c2 : c2,
                  c3 : c3,
                  c4 : c4,
                  c5 : c5
              },
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
</body>

</html>