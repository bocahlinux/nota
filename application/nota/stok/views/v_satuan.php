<script type="text/javascript">

  var save_method; //for save method string
  var dtSatuan;

  function tambah_data()
  {
      save_method = 'add_satuan';
      $('#form_satuan')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      //$('#modal_form_satuan').modal('show'); // show bootstrap modal
      $('#modal_form_satuan').modal(
      {
        backdrop: false,
        keyboard: false
      });
      // show bootstrap modal
      $('.modal-title').text('Tambah Satuan'); // Set Title to Bootstrap modal title
       $.ajax({
          url : "<?php echo base_url('stok/barang/tambah_satuan')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="kd_sat"]').val(data);
              $('[name="kd_sat"]').attr("readonly",true);
              $("#nm_satuan").focus();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function reload_tb_sat()
  {
      dtSatuan.ajax.reload(null,false); //reload datatable ajax
      dtBarang.ajax.reload(null,false); //reload datatable ajax
  }
  function reload_sat()
  {
      dtSatuan.ajax.reload(null,false); //reload datatable ajax
  }

  function edit_satuan(kd_satuan){
  {
      save_method = 'update_satuan';
      $('#form_satuan')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo base_url('stok/barang/cari_satuan/')?>/" + kd_satuan,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="kd_sat"]').val(data.kd_satuan);
              $('[name="kd_sat"]').attr("readonly",true);
              $('[name="nm_satuan"]').val(data.ket_satuan);
              $('[name="nm_satuan"]').focus();
              $('#modal_form_satuan').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Satuan'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }
}

function delete_person(kd_satuan)
{
    if(confirm('Anda Yakin akan Menghapus Data Ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('stok/barang/hapus_satuan')?>/"+kd_satuan,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form_satuan').modal('hide');
                reload_tb_sat();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

function save_satuan()
{
    $('#simpan_satuan').text('saving...'); //change button text
    $('#simpan_satuan').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add_satuan') {
        url = "<?php echo base_url('stok/barang/simpan_data_sat')?>";
    }
    if(save_method == 'update_satuan') {
        url = "<?php echo base_url('stok/barang/simpan_edit_sat')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_satuan').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form_satuan').modal('hide');
                reload_tb_sat();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#simpan_satuan').text('Simpan'); //change button text
            $('#simpan_satuan').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#simpan_satuan').text('Simpan'); //change button text
            $('#simpan_satuan').attr('disabled',false); //set button enable
        }
    });
}

</script>
      <!-- /.Tabel Satuan Barang -->
      <div class="box box-success ">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $judul_satuan;?></h3>
            <div class="widget-toolbar no-border pull-right" style="margin-left:5px">
				<button class="btn btn-block btn-xs btn-info" data-widget="collapse" onclick="reload_sat()">
					<i class="fa fa-minus"></i>
				</button>
            </div>
            <div class="widget-toolbar no-border pull-right">
				<button class="btn btn-block btn-xs btn-success" onclick="tambah_data()">
					<i class="fa fa-plus-circle"></i> Tambah
				</button>
            </div>
        </div>
        <div class="box-body">
          <div class="small table-responsive">
            <table id="Satuan" name="Satuan" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr class="success">
                  <th style="text-align: center">Kode</th>
                  <th style="text-align: center">Satuan</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

<div class="modal fade" id="modal_form_satuan" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="margin-top:150px">
            <div class="modal-header bg-green">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body my-form">
                <form action="#" id="form_satuan" class="form-horizontal">
                    <div class="form-body">
                      <div class="form-group">
                        <label class="control-label col-md-4">Kode Satuan</label>
                          <div class="col-md-4">
                              <input  name="kd_sat" id="kd_sat" placeholder="Kode Satuan" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-4">Nama Satuan</label>
                          <div class="col-md-6">
                            <input name="nm_satuan" id="nm_satuan" placeholder="Nama Satuan" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                      </div>
                    </div>
                 </form>
            </div>
            <div class="modal-footer bg-green">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="button"  onclick="save_satuan()"  id="simpan_satuan" class="btn btn-small btn-info pull-right">
                  <i class="icon-save"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".select2").select2();

    $("#nm_satuan").keyup(function(e)
    {
      var isi = $(e.target).val();
      $(e.target).val(isi.toUpperCase());
    });

    dtSatuan = $('#Satuan').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "ordering": true,
      "paging":   false,
      "info":     false,
      "filter": false,
      "scrollY": '42vh',
      "scrollCollapse": true,
      "pagingType": 'simple_numbers',
      "lengthMenu": [[20, 30, 40, 50, -1], [20, 30, 40, 50, 'All']],
      "autoWidth": false,

      "dom": 't<"clear">',
       //"dom": '<"Satuan">ft<"clear">',
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('stok/barang/get_list_dtSatuan')?>",
        "type": "POST"
      },

      "language": {
        "lengthMenu": '_MENU_ data',
        "zeroRecords": 'Data Tidak Ditemukan',
        "info": 'Hal ke _PAGE_ dari _PAGES_ (Total _MAX_ Data)',
        "infoEmpty": 'Tidak Ada Data',
        "infoFiltered": '(filter dari _MAX_ total data)',
        "sProcessing": "Harap Tunggu, sedang memproses Data Barang...",
      },
      //Set column definition initialisation properties.
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "35%", "targets": 1 },
        { "width": "10%", "targets": 2 },
        { "targets": [ 2 ], "orderable": false,},

      ],
    });

    //datepicker
    $('.datepicker').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      todayHighlight: true,
      orientation: "top auto",
      todayBtn: true,
      todayHighlight: true,
    });
  });
</script>
