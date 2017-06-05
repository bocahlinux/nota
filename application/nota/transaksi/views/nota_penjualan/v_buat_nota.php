      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $sub_judul;?></h3>
            <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-block btn-xs btn-primary" onclick="tambah_brg()">Tambah </button>
            </div>
        </div>
        <div class="box-body">
          <div class="small table-responsive">
            <table id="Barang" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr class="info">
                  <th style="text-align: center">Kode</th>
                  <th style="text-align: center">Nama Barang</th>
                  <th style="text-align: center">Harga</th>
                  <th style="text-align: center">Stok</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Bootstrap modal -->
<div  class="modal fade" id="modal_form_barang" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="margin-top:100px">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body my-form">
                <form action="#" id="form_barang" class="form-horizontal">
                    <div class="form-body">
                      <div class="form-group">
                        <label class="control-label col-md-4">Kode Barang</label>
                          <div class="col-md-3">
                            <input  name="kd_brg" id="kd_brg" placeholder="Kode Barang" class="form-control" type="text">
                            <span class="help-block"></span>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4">Nama Barang</label>
                          <div class="col-md-6">
                            <input name="nm_brg" id="nm_brg" placeholder="Nama Barang" class="form-control" type="text" maxlength="35">
                            <span class="help-block"></span>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4">Stok Barang</label>
                          <div class="col-md-2">
                              <input  name="stok_brg" id="stok_brg" placeholder="Stok Barang" class="form-control" type="text" maxlength="3">
                              <span class="help-block"></span>
                          </div>


                          <div class="col-sm-3">
                            <select id="cari_satuan" name="cari_satuan">
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
                        <label for="harga_brg" class="control-label col-sm-4">Harga Barang</label>
                          <div class="col-sm-3">
                            <input id="harga_brg" name="harga_brg" placeholder="Harga Barang" class="form-control" type="text" maxlength="7">
                          <span class="help-block"></span>
                        </div>
                      </div>

                    </div>
                 </form>
            </div>
            <div class="modal-footer bg-primary">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button"  onclick="save_brg()"  id="simpan_barang" class="btn btn-small btn-success pull-left">
                    <i class="icon-save"></i>
                    Simpan
                </button>
            </div>
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
      "scrollY":'28vh',
      "scrollCollapse": true,
      "pagingType": 'simple_numbers',
      "deferRender":true,
      "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, 'All']],
      "autoWidth": false,

      //"dom": '<"top"lf>t<"bottom"ip><"clear">',
       //"dom": '<"top"lif>trp',
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('master/barang/get_list_dtBarang')?>",
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
