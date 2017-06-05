<script type="text/javascript">

  var save_method; //for save method string
  var dtBarang;

  $(document).ready(function(){

  $("#harga_brg").keypress(function(data)
  {
    if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    {
            return false;
        }
    });

  $("#stok_brg").keypress(function(data)
  {
    if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    {
      return false;
    }
  });

  $("#nm_brg").keyup(function(e)
  {
    var isi = $(e.target).val();
    $(e.target).val(isi.toUpperCase());
    });

  $("#kd_brg").keyup(function(e)
  {
    var isi = $(e.target).val();
    $(e.target).val(isi.toUpperCase());
    });

  });

  function tambah_brg()
  {
      save_method = 'add_brg';
      $('#form_barang')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_form_barang').modal({
        backdrop: false,
        keyboard: false
      }); // show bootstrap modal
      $('.modal-title').text('Tambah Barang'); // Set Title to Bootstrap modal title

       $.ajax({
          url : "<?php echo base_url('stok/barang/tambah_barang')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="kd_brg"]').val(data);
              $('[name="kd_brg"]').attr("readonly",true);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function reload_tb_brg()
  {
      dtBarang.ajax.reload(null,false); //reload datatable ajax
  }

  function edit_barang(kd_brg){
  {
      save_method = 'update_brg';
      $('#form_barang')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo base_url('stok/barang/cari_barang/')?>/" + kd_brg,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="kd_brg"]').val(data.kd_brg);
              $('[name="kd_brg"]').attr("readonly",true);
              $('[name="nm_brg"]').val(data.nm_brg);
              $('[name="stok_brg"]').val(data.stok_brg);
              $('[name="cari_satuan"]').val(data.kd_satuan);
              $('[name="harga_brg"]').val(data.harga);
              $('[name="nm_brg"]').focus();
              $('#modal_form_barang').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }
}

function delete_barang(kd_brg)
{
    if(confirm('Anda Yakin akan Menghapus Data Ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('stok/barang/hapus_barang')?>/"+kd_brg,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form_barang').modal('hide');
                reload_tb_brg();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

function save_brg()
{
    $('#simpan_barang').text('saving...'); //change button text
    $('#simpan_barang').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add_brg') {
        url = "<?php echo base_url('stok/barang/simpan_data_brg')?>";
    }
    if (save_method == 'update_brg') {
        url = "<?php echo base_url('stok/barang/simpan_edit_brg')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_barang').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form_barang').modal('hide');
                reload_tb_brg();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#simpan_barang').text('Simpan'); //change button text
            $('#simpan_barang').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#simpan_barang').text('Simpan'); //change button text
            $('#simpan_barang').attr('disabled',false); //set button enable
        }
    });
}

</script>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            Daftar Nota Penjualan Barang
          </h3>
            <div class="widget-toolbar no-border pull-right" style="margin-left:5px">
      				<button class="btn btn-block btn-xs btn-info" data-widget="collapse">
      					<i class="fa fa-minus"></i>
      				</button>
            </div>
      			<div class="widget-toolbar no-border pull-right" style="margin-right:5px">
      				<button class="btn btn-block btn-xs btn-success" onclick="reload_tb_brg()">
      					<i class="fa fa-refresh"></i> Reload Data
      				</button>
            </div>
        </div>
        <div class="box-body">
          <div class="small table-responsive">
            <table id="Barang" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr class="info">
                  <th style="text-align: center">Kode Transaksi</th>
                  <th style="text-align: center">Tanggal Transaksi</th>
                  <th style="text-align: center">Total Pembelian</th>
                  <th style="text-align: center">Total Pembayaran</th>
                  <th style="text-align: center">Keterangan</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
<script type="text/javascript">
  var save_method; //for save method string
  var dtBarang;

  $(document).ready(function() {

    //datatables
    dtBarang = $('#Barang').DataTable({
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
        "url": "<?php echo site_url('transaksi/Cetak_Nota/get_list_Penjualan')?>",
        "type": "POST"
      },

      "language": {
        "lengthMenu": 'Tampilkan _MENU_ data',
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
        { "width": "5%", "targets": 3 },
        { "width": "5%", "targets": 4 },
        { "targets": [ 4 ], "orderable": false,},
      ],
    });

  });
</script>
