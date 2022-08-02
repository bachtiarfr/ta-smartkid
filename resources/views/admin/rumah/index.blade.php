@extends('adminlte::page')

@section('title', 'Data Kriteria Kondisi Tempat Tinggal')

@section('content_header')
    <h1>Data Kriteria Kondisi Tempat Tinggal</h1>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <table callpadding="0" cellspacing="0" bordered="0" class="dataTable" id="example">
                <thead>
                    <tr>
                        <th> Keterangan Tempat Tinggal </th>
                        <th> Kategori Penilain </th>
                        <th> Bobot/Nilai </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
        $(function () {
            let baris = '';
            {{ $no = 1;  }}

            $.ajax({
                type: "GET",
                url: "/admin/getrumah",
                dataType: "JSON",
                success: function (response) {
                    $.each(response, function (idx, val) {
                        console.log(val);
                         baris += `
                            <tr>
                                <td style="vertical-align: middle" class="tdName"> ${val.keterangan} </td>
                                <td style="vertical-align: middle"> ${val.key} </td>
                                <td style="vertical-align: middle"> ${val.value} </td>
                                <td class="tdAction${val.rumah_id}">
                                    @if ( $no == 1 )
                                        <a class="btn btn-warning" href="{{ URL::to('admin/editrumah/${val.rumah_id}') }}"> Ubah </a>
                                        <a class="btn btn-danger" href="{{ URL::to('admin/hapusrumah/${val.rumah_id}') }}"> <i class="fa fa-trash-o" style="font-size:24px"> </i> </a> 
                                    @endif

                                    @php
                                        $no++
                                    @endphp
                                    
                                </td>
                         `;
                    });
                    $('#example').append(baris)
                }
            });
      
          setTimeout(MergeGridCells, 800)
      
          function MergeGridCells() {
              var dimension_cells = new Array();
              var dimension_col = null;
              var columnCount = $("#example tr:first th").length;
              for (dimension_col = 0; dimension_col < columnCount; dimension_col++) {
              // first_instance holds the first instance of identical td
                  var first_instance = null;
                  var rowspan = 1;
              // iterate through rows
                  $("#example").find('tr').each(function () {
                      // find the td of the correct column (determined by the dimension_col set above)
                      var dimension_td = $(this).find('td.tdName:nth-child(' + dimension_col + ')');
      
                      if (first_instance == null) {
                          // must be the first row
                          first_instance = dimension_td;
                      } else if (dimension_td.text() == first_instance.text()) {
                          // the current td is identical to the previous
                          // remove the current td
                          dimension_td.remove();
                          ++rowspan;
                          // increment the rowspan attribute of the first instance
                          first_instance.attr('rowspan', rowspan);
                          first_instance.css("vertical-align", "middle")
                      } else {
                          // this cell is different from the last
                          first_instance = dimension_td;
                          rowspan = 1;
                      }
                  });
                  
                    var actionCount = $("#example .tdAction"+ dimension_col +"");
                    console.log("action count :", actionCount);
                    if (actionCount.length > 1) {
                        actionCount.not(':last').remove();
                    }
              }
          }
          
        });
      </script>
@stop