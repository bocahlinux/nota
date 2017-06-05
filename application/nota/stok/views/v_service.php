<script type="text/javascript">

  var save_method; //for save method string
  var dtService;

  $(document).ready(function(){

  $("#harga_srv").keypress(function(data)
  {
    if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    {
            return false;
        }
    });

  $("#jns_service").keyup(function(e)
  {
    var isi = $(e.target).val();
    $(e.target).val(isi.toUpperCase());
    });

  $("#kd_service").keyup(function(e)
  {
    var isi = $(e.target).val();
    $(e.target).val(isi.toUpperCase());
    });

  });

  function tambah_srv()
  {
      save_method = 'add_srv';
      $('#form_service')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_form_service').modal({
        backdrop: false,
        keyboard: false
      }); // show bootstrap modal
      $('.modal-title').text('Tambah Data Service'); // Set Title to Bootstrap modal title

       $.ajax({
          url : "<?php echo base_url('stok/c_service/tambah_service')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="kd_service"]').val(data);
              $('[name="kd_service"]').attr("readonly",true);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function reload_tb_srv()
  {
      dtService.ajax.reload(null,false); //reload datatable ajax
  }

  function edit_service(kd_service){
  {
      save_method = 'update_srv';
      $('#form_service')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo base_url('stok/c_service/cari_service/')?>/" + kd_service,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="kd_service"]').val(data.kd_service);
              $('[name="kd_service"]').attr("readonly",true);
              $('[name="jns_service"]').val(data.nm_service);
              $('[name="harga_service"]').val(data.harga_service);
              $('[name="jns_service"]').focus();
              $('#modal_form_service').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Harga Service'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }
}

function delete_service(kd_service)
{
    if(confirm('Anda Yakin akan Menghapus Data Ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('stok/c_service/hapus_srv')?>/"+kd_service,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form_service').modal('hide');
                reload_tb_srv();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

function save_srv()
{
    $('#simpan_service').text('saving...'); //change button text
    $('#simpan_service').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add_srv') {
        url = "<?php echo base_url('stok/c_service/simpan_data_srv')?>";
    }
    if (save_method == 'update_srv') {
        url = "<?php echo base_url('stok/c_service/simpan_edit_srv')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_service').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form_service').modal('hide');
                reload_tb_srv();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#simpan_service').text('Simpan'); //change button text
            $('#simpan_service').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#simpan_service').text('Simpan'); //change button text
            $('#simpan_service').attr('disabled',false); //set button enable
        }
    });
}

</script>

      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $judul_service;?></h3>
            <div class="widget-toolbar no-border pull-right" style="margin-left:5px">
				<button class="btn btn-block btn-xs btn-info" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
            </div>
            <div class="widget-toolbar no-border pull-right">
				<button class="btn btn-block btn-xs btn-warning" onclick="tambah_srv()">
					<i class="fa fa-plus-circle"></i> Tambah
				</button>
            </div>
			<div class="widget-toolbar no-border pull-right" style="margin-right:5px">
				<button class="btn btn-block btn-xs btn-success" onclick="reload_tb_srv()">
					<i class="fa fa-refresh"></i> Reload Data
				</button>
            </div>
        </div>
        <div class="box-body">
          <div class="small table-responsive">
            <table id="service" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr class="warning">
                  <th style="text-align: center">Kode</th>
                  <th style="text-align: center">Jenis Perbaikan</th>
                  <th style="text-align: center">Harga</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>


      <!-- Bootstrap modal -->
<div  class="modal fade" id="modal_form_service" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="margin-top:150px">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body my-form">
              <form action="#" id="form_service" class="form-horizontal">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4">Kode Service</label>
                      <div class="col-md-3">
                        <input  name="kd_service" id="kd_service" placeholder="Kode Service" class="form-control" type="text">
                        <span class="help-block"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Jenis Service</label>
                      <div class="col-md-6">
                        <input name="jns_service" id="jns_service" placeholder="Jenis Service" class="form-control" type="text" maxlength="35">
                        <span class="help-block"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="harga_service" class="control-label col-sm-4">Harga</label>
                      <div class="col-sm-3">
                        <input id="harga_service" name="harga_service" placeholder="Harga" class="form-control" type="text" maxlength="7">
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer bg-primary">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="button"  onclick="save_srv()"  id="simpan_service" class="btn btn-small btn-success pull-left">
                <i class="icon-save"></i>Simpan
              </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  var save_method; //for save method string
  var dtService;

  $(document).ready(function() {

    //datatables
    dtService = $('#service').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "ordering": true,
      "info":true,
      "scrollY":'33vh',
      "scrollCollapse": true,
      "pagingType": 'simple_numbers',
      "deferRender":true,
      "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, 'All']],
      "autoWidth": false,

      //"dom": '<"top"lf>t<"bottom"ip><"clear">',
       //"dom": '<"top"lif>trp',
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo base_url('stok/c_service/get_list_dtService')?>",
        "type": "POST"
      },

      "language": {
        "lengthMenu": 'Tampilkan _MENU_ data',
        "zeroRecords": 'Data Tidak Ditemukan',
        "info": 'Hal ke _PAGE_ dari _PAGES_ (Total _MAX_ Data)',
        "infoEmpty": 'Tidak Ada Data',
        "infoFiltered": '(filter dari _MAX_ total data)',
        "sProcessing": "Harap Tunggu, sedang memproses Data Service...",
      },
      //Set column definition initialisation properties.
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "35%", "targets": 1 },
        { "width": "10%", "targets": 2 },
        { "width": "5%", "targets": 3 },

        { "targets": [ 3 ], "orderable": false,},
      ],
    });

  });
</script>
