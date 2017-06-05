
<script type="text/javascript">
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

	
	$('#simpan').click(function()
	{
		
	});
  
	$("#tbh_brg").click(function()
	{
		min_brg.click();
		$("#nm_brg").val('');
		$("#stok_brg").val('');
		$("#cari_satuan").val('-');
		$("#harga_brg").val('');
		$("#nm_brg").focus();
	});
});
</script>

<script src="<?php echo base_url();?>assets/admin_lte/bootstrap/js/popover.js"></script>
<script src="<?php echo base_url();?>assets/admin_lte/bootstrap/js/tooltip.js"></script>


      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Barang</h3>
          <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-block btn-xs btn-info"  name="tbh_brg" id="tbh_brg">Tambah Barang</button>
              <button class="btn btn-box-tool sr-only" id="min_brg" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <form class="form-horizontal" id="frm_input_brg">
          <div class="box-body">
            <div class="form-group">
                <label for="kd_brg" class="col-sm-5 control-label">Kode Barang</label>
              <div class="col-sm-4">
                <input disabled type="text" class="form-control" id="kd_brg" placeholder="Kode Barang" data-toggle="tooltip" data-placement="bottom" title="Kode Otomatis" value="<?php echo $kd_brg;?>">
              </div>                      
            </div>
            <div class="form-group">
              <label for="nm_brg" class="col-sm-5 control-label">Nama Barang</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="nm_brg"  placeholder="Nama Barang">
              </div>
            </div>
            <div class="form-group">
              <label for="stok_brg" class="control-label col-sm-5">Stok Barang</label>
              <div class="col-sm-4">
                  <input id="stok_brg" placeholder="Stok Barang" class="form-control" type="text" maxlength="3">
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
                  <input id="harga_brg" placeholder="Harga Barang" class="form-control" type="text" pattern="(\d{3})([\.])(\d{2})">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-danger" data-widget="collapse" data-toggle="tooltip" data-placement="right" title="Batal Menyimpan">Batal</button>
            <button type="button" class="btn btn-info pull-right" name="simpan" id="simpan" data-toggle="tooltip" data-placement="left" title="Simpan Data">Simpan</button>
          </div>
        </form>
      </div>