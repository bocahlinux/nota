
<script type="text/javascript">
  $(document).ready(function(){

   $("#harga_brg").keypress(function(data){
        if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
            return false;
        }
    });
   $("#stok_brg").keypress(function(data){
        if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
            return false;
        }
    });

    $("#nm_brg").keyup(function(e){
      var isi = $(e.target).val();
      $(e.target).val(isi.toUpperCase()); 
    });

    $("#kd_brg").keyup(function(e){
      var isi = $(e.target).val();
      $(e.target).val(isi.toUpperCase()); 
    });
  });


</script>

<section class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $sub_judul;?></h3>
            <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <div class="small table-responsive">
            <table id="Barang" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr class="info">
                  <th >Kode</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Stok</th>                        
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      
      
              
    </div>
    <div class="col-md-4">
      <!-- Form Input Stok Barang -->
      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Barang</h3>
          <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-block btn-xs btn-info" id="tbh_stok_brg" data-widget="collapse">
                  Tambah Barang 
              </button>
            </div>
        </div>
        <form class="form-horizontal" id="frm_input_brg">
          <div class="box-body">
            <div class="form-group">
                <label for="kd_brg" class="col-sm-5 control-label">Kode Barang</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="kd_brg" placeholder="Kode Barang">
              </div>                      
            </div>
            <div class="form-group">
              <label for="nm_brg" class="col-sm-5 control-label">Nama Barang</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="nm_brg" placeholder="Nama Barang">
              </div>
            </div>
            <div class="form-group">
              <label for="stok_brg" class="control-label col-sm-5">Stok Barang</label>
              <div class="col-sm-4">
                  <input id="stok_brg" placeholder="Stok Barang" class="form-control" type="text">
                  <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="cari_satuan" class="control-label col-sm-5">Satuan Barang</label>
                <div class="col-sm-3">
                  <select id="cari_satuan">
                        <option value="-">--</option>
                        <?php
                        $data = $this->Barang->cari_dt_satuan();
                        foreach($data->result() as $dt){
                        ?>
                        <option value="<?php echo $dt->kd_satuan;?>"><?php echo $dt->ket_satuan;?></option>
                        <?php
                        }
                        ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label for="harga_brg" class="control-label col-sm-5">Harga Barang</label>
                <div class="col-sm-5">
                  <input id="harga_brg" placeholder="Harga Barang" class="form-control" type="text">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-danger" data-widget="collapse">Batal</button>
            <button type="submit" class="btn btn-info pull-right" id="input_brg">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.Akhir Form Tambah Barang -->

      <!-- Form Input Satuan Barang -->
      <div class="box box-success collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Satuan</h3>
          <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-block btn-xs btn-success" id="tbh_stok_brg" data-widget="collapse">
                  Tambah Satuan 
              </button>
            </div>
        </div>
        <form class="form-horizontal" id="frm_input_sat">
          <div class="box-body">
            <div class="form-group">
                <label for="kd_sat" class="col-sm-5 control-label">Kode Satuan</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="kd_sat" placeholder="Kode Satuan">
              </div>                      
            </div>
            <div class="form-group">
              <label for="nm_satuan" class="col-sm-5 control-label">Nama Satuan</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="nm_satuan" placeholder="Nama Satuan Barang">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-danger" data-widget="collapse">Batal</button>
            <button type="submit" class="btn btn-success pull-right" id="input_sat">Simpan</button>
          </div>
        </form>
      </div>
      <!-- AKhir Form Input Satuan Barang -->

      <!-- /.Tabel Satuan Barang -->
      <div class="box box-danger ">
        <div class="box-header with-border">
          <h3 class="box-title">Satuan Barang</h3>
            <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
        <div class="box-body">
          <div class="small table-responsive">
            <table id="Satuan" name="Satuan" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr class="danger">
                  <th>Kode</th>
                  <th>Satuan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- Akhir Tabel Satuan Barang -->
    </div>

  </div>

</section>
            

<!--
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script> 
<script src="<?php echo base_url();?>assets/admin_lte/dist/js/pages/dashboard.js"></script>
-->
<script src="<?php echo base_url('assets/admin_lte\plugins\datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin_lte\plugins\datatables/dataTables.bootstrap.js')?>"></script>

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
      "scrollY":'38vh',
      "scrollCollapse": true,
      "pagingType": 'simple_numbers',
      "deferRender":true,
      "lengthMenu": [[20, 30, 40, 50, -1], [20, 30, 40, 50, 'All']],
      "autoWidth": false,
      "deferRender": false,
      
       //"dom": '<"top"lif>trp',
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('Master/Barang/get_list_dtBarang')?>",
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

<script type="text/javascript">
  var save_method; //for save method string
  var dtSatuan;

  $(document).ready(function() {
    
    //datatables
    dtSatuan = $('#Satuan').DataTable({ 

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "ordering": true,
      "info":false,
      "pagging":false,
      "scrollY":'30vh',
      "scrollCollapse": true,
      "pagingType": 'simple_numbers',
      "deferRender":true,
      "lengthMenu": [[20, 30, 40, 50, -1], [20, 30, 40, 50, 'All']],
      "autoWidth": false,
      "deferRender": false,
      
       "dom": '<"Satuan">ft<"clear">',
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('Master/Barang/get_list_dtSatuan')?>",
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


<!-- Bootstrap modal -->
<div  class="modal fade" id="modal_form_brg" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="margin-top:60px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Stok Barang</h3>
            </div>
            <div class="modal-body form_blmPajak">
                <form action="#" id="form_blmPajak" class="form-horizontal">
                  <input type="hidden" value="" name="no_dft"/> 
                    <div class="form-body">
                      <div class="form-group">
                        <label class="control-label col-md-4">Kode Barang</label>
                          <div class="col-md-4">
                              <input name="kd_brg" id="kd_brg" placeholder="Kode Barang" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-4">Nama Barang</label>
                          <div class="col-md-6">
                            <input name="nm_brg" id="nm_brg" placeholder="Nama Barang" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4">Harga Barang</label>
                          <div class="col-md-3">
                              <input name="harga_brg" id="harga_brg" placeholder="Harga Barang" class="form-control" type="text">
                             <span class="help-block"></span>
                          </div>
                      </div>

                        <div class="form-group">
                          <label class="control-label col-md-4">Satuan Barang</label>
                          <div class="col-md-2">
                            <select name="cari_satuan" id="cari_satuan">
                                <option value="-">--</option>
                                <?php
                                $data = $this->Barang->cari_dt_satuan();
                                foreach($data->result() as $dt){
                                ?>
                                <option value="<?php echo $dt->kd_satuan;?>"><?php echo $dt->ket_satuan;?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">

                          <label class="control-label col-md-4">Stok Barang</label>
                          <div class="col-md-4">
                              <input name="stok_brg" id="stok_brg" placeholder="Stok Barang" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                      </div>                      
                    </div>
                 </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

  
