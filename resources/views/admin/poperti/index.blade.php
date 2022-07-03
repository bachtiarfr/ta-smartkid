@extends('adminlte::page')

@section('title', 'Data Kriteria Kepemilikan Asset')

@section('content_header')
    <h1>Data Kriteria Kepemilikan Asset</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <table callpadding="0" cellspacing="0" bordered="0" class="dataTable" id="example">
                <thead>
                    <tr>
                        <th> Jenis Assets </th>
                        <th> Kategori </th>
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
                url: "/admin/getassets",
                dataType: "JSON",
                success: function (response) {
                    $.each(response, function (idx, val) {
                        console.log(val);
                         baris += `
                            <tr>
                                <td> ${val.nama} </td>
                                <td> ${val.key} </td>
                                <td> ${val.value} </td>
                                <td>
                                    @if ( $no == 1 )
                                        <a class="btn btn-warning" href="{{ URL::to('admin/editassets/${val.assets_id}') }}"> Ubah </a>
                                        <a class="btn btn-danger" href="#"> <i class="fa fa-trash-o" style="font-size:24px"> </i> </a> 
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
                      var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');
      
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
                      } else {
                          // this cell is different from the last
                          first_instance = dimension_td;
                          rowspan = 1;
                      }
                  });
              }
          }
          
        });
      </script>
@stop