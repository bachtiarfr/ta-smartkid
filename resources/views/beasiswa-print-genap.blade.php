<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SMARTKID - Aplikasi Beasiswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->

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
            <div class="header" style="text-align: center; display: flex; align-items: center; column-gap: 10px; justify-content: center;">
                <div>
                    <img src="https://ppdb.smkmaarifkotamungkid.sch.id/img/smaja.png" alt="" width="150">
                </div>
                <div>
                    <div class="main-text">
                        <p style="margin: 0; font-size: 14px">LEMBAGA PENDIDIKAN MA'ARIF NU KAB.MAGELANG</p>
                        <h1 style="margin: 5px 0; font-size: 23px">SMK MA'ARIF KOTA MUNGKID</h1>
                        <p style="margin: 0; font-size: 12px">
                            TEKNIK MESIN <BR>
                            TEKNIK JARINGAN KOMPUTER DAN TELEKOMUNIKASI <BR>
                            TEKNIK OTOMOTIF <BR>
                            TEKNIK KIMIA INDUSTRI
                        </p>
                    </div>
                    <p style="font-size: 10px">JL. LETNAN TUKIYAT KOTA MUNGKID MAGELANG 56511 / FAX (0293) 788802</p> 
                   <div style="display: flex; justify-content: space-between; column-gap: 10px; font-size: 10px">
                        <div style="text-align: left">
                            Email : <a href="mailto:admin@smkmaarifkotamungkid.sch.id">smkmaarifkotamungkid.sch.id</a><br>
                            NSS : 324030811002 <br>
                            NIS : 400210 <br>
                        </div>
                        <div style="text-align: left">
                            Website : <a href="smkmaarifkotamungkid.sch.id">smkmaarifkotamungkid.sch.id</a><br>
                            NIDS : 420331900011 <br>
                            NPSN : 20307722 <br>
                        </div>
                    </div>
                </div>
                <div class="kop-image">
                    <img src="https://www.mcgregorsurveys.com.au/wp-content/uploads/2020/03/badge_ISO-9001-Certified-Equal-Assurance.png" alt="" width="150">
                </div>
            </div>
            <br>
            <hr>
            <div class="col-md-12">
                <h2 style="text-align: center">LAPORAN HASIL SELEKSI BEASISWA</h2>
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                Periode: {{$periodeYear}}/Genap
                                <table id="tblhasil" style="border: 1px solid #000; border-collapse: collapse; margin: auto; margin-top: 20px">
                                    <thead>
                                        <tr>
                                            <td style="border: 1px solid #000; padding: 5px 10px">No</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px">NISN</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px; width: 120px"> Nama Siswa </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> Kelas</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px; width: 190px"> Nama Orang Tua</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> K1</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> K2</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> K3</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> K4</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> K5</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> Score </td>
                                        </tr>
                                    </thead>
                                    <tbody id="v-hasil">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataPerangkingan as $data)
                                        <tr class="item-list" data-value="{{ $data["w"] }}" style="border-bottom: 1px solid #000">
                                            <td style="border: 1px solid #000; padding: 5px 10px">{{ $i; }}</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px">{{ $data["nisn"] }}</td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["nama"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["kelas"] . ' - ' . $data["jurusan"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["nama_ortu"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["v1"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["v2"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["v3"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["v4"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["v5"] }} </td>
                                            <td style="border: 1px solid #000; padding: 5px 10px"> {{ $data["w"] }} </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    </div>
                </div>
            </div>
            <div class="tanda-tangan" style="position: absolute; right: 20px; bottom: 20px; text-align: center">
                Kepala Sekolah <br>
                <br>
                <br>
                <br>
                <br>
                <u><strong>Ngungun Bayu Santoso, S.Kom</strong></u>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    window.print();
    setTimeout(historyBack, 1000)
    function historyBack() {
        history.back();
    }
</script>