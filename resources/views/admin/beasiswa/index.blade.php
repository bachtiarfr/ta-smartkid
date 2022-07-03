@extends('adminlte::page')

@section('title', 'Data Siswa')

@section('content_header')
    <h1>Data Siswa</h1>
@stop

@section('content')

    {{-- index  --}}

    <a id="btntambah" href="#"> <i class="fa fa-plus" style="font-size:24px"> </i> </a>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none">
        <strong> Success! </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    {{-- datatables --}}

    <table class="display" id="tblbeasiswa">
        <thead>
            <tr>
                <th> ID </th>
                <th> NAMA BEASISWA </th>
                <th width="150" class="text-center"> Action </th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>


    {{-- pop up tambah --}}

    <div id="mdltambah" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title"> Tambah Jenis Beasiswa </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                

                <div class="form-group" >
                    <label> Nama Beasiswa: </label>
                    <input type="text" class="form-control" name="nama_beasiswa" id="nama_beasiswa" >
                </div>
              
            </div>

            <div class="modal-footer">
              <button id="btnsimpan" type="button" class="btn btn-success"> Simpan </button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>

          </div>
        </div>
      </div>

      {{-- popup edit --}}

      <div id="mdledit" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <input type="hidden" name="id" id="id">

            <div class="modal-header">
              <h5 class="modal-title"> Edit Jenis Beasiswa </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                

                <div class="form-group" >
                    <label> Nama Beasiswa: </label>
                    <input type="text" class="form-control" name="txtnama_beasiswa" id="txtnama_beasiswa" >
                </div>
              
            </div>

            <div class="modal-footer">
              <button id="btnubah" type="button" class="btn btn-success"> Ubah </button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>

          </div>
        </div>
      </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // ajax datatable

        $(function () {
            
            let tblbeasiswa = $('#tblbeasiswa').DataTable( {
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 5,
                ajax : '{{ URL::to('http://127.0.0.1:8000/admin/getBeasiswa') }}',
                columns : [
                    { data : 'id', name : 'id'},
                    { data : 'nama_beasiswa' , name : 'nama_beasiswa' },
                    { data : 'Actions' , name : 'Actions' , }
                ]

            });

            $('#btntambah').click(function (e) { 
                e.preventDefault();
                $('#mdltambah').modal('show');
                // alert('ini muncul');
            });

            // ajax tampil data update

            $('body').on( 'click' , '#btnEdit' , function () {
                                              
                let id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/admin/beasiswa/" + id,
                    dataType: "JSON",
                    success: function (response) {
                        console.log( response );
                        $('#txtnama_beasiswa').val( response.nama_beasiswa );
                        $('#id').val(response.id);
                    }
                });

                $('#mdledit').modal('show');

            });

            // ajax dalate data

            $('body').on('click' , '#btnDelete' , function (e) {
                e.preventDefault();

                // sweetalert

                swal({
                        title: "Apakah Anda Yakin?",
                        text: "Jika dihapus data tidak bisa kembali!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            let id = $(this).data('id');

                            $.ajax({
                                type: "DELETE",
                                url: "http://127.0.0.1:8000/admin/beasiswa/" + id,
                                dataType: "JSON",
                                success: function (response) {

                                    if ( response.pesan ) {
                            
                                        $('.alert-danger').hide();
                                        $('.alert-success').show();

                                        $('.datatable').DataTable().ajax.reload();

                                        setInterval(function() {
                                            $('.alert-success').hide();
                                            location.reload();
                                        }, 800);
                                
                                    }
                                    
                                }
                            });

                            swal("Data berhasil dihapus", {
                            icon: "success",
                        });
                    }
                });

            });

            // ajax simpan update data 
            
            $('#btnubah').click(function (e) { 
                e.preventDefault();
                console.log('tombol ubah diklik');
                $('#mdledit').modal('hide');
                
                let id = $('#id').val();

                $.ajax({
                    type: "PUT",
                    url: "http://127.0.0.1:8000/admin/beasiswa/" + $.trim(id),
                    data: {
                        "nama_beasiswa" : $("#txtnama_beasiswa").val(),
                        "user_id" : {{ Auth::user()->id }}
                    },
                    success: function (response) {
                        if ( response.pesan ) {
                            
                                $('.alert-danger').hide();
                                $('.alert-success').show();

                                $('.datatable').DataTable().ajax.reload();

                            setInterval(function() {
                                $('.alert-success').hide();
                                location.reload();
                            }, 800);

                        } else {
                            console.log('gagal')
                        }
                    }
                });
            });

            // ajax simpan tambah data

            $('#btnsimpan').click(function (e) { 
                e.preventDefault();
                

                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('http://127.0.0.1:8000/admin/beasiswa') }}",
                    data: {
                        nama_beasiswa: $('#nama_beasiswa').val(),
                        user_id: 1
                    },
                    success: function (response) {
                        if ( response.pesan ) {
                            
                            $('.alert-danger').hide();
                            $('.alert-success').show();

                            $('.datatable').DataTable().ajax.reload();

                            setInterval(function() {
                                $('.alert-success').hide();
                                $('#mdltambah').modal('hide');
                                location.reload();
                            }, 800);

                        } else {
                            console.log('gagal')
                        }
                    }
                });

            });

        });
    </script>
@stop