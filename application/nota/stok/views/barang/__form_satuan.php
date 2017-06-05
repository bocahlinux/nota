
<script type="text/javascript">
  $(document).ready(function(){
    $("#kd_satuan").keyup(function(e){
      var isi = $(e.target).val();
      var isi = $(e.target).val();
      $(e.target).val(isi.toUpperCase()); 
    });

    $("#ket_satuan").keyup(function(e){
      var isi = $(e.target).val();
      $(e.target).val(isi.toUpperCase()); 
    });
	
	$("#tbh_stok_brg").click(function()
	{
		min_sat.click();
		$("#ket_satuan").val('');
		$("#ket_satuan").focus();
	})
	
	$("#input_sat").click(function(){
        var string = $("#my-form").serialize();
        var kd_satuan =  $("#kd_satuan").val();
        var ket_satuan =  $("#ket_satuan").val();
        if(ket_satuan.length==0){
          alert('Maaf, Nama Satuan Tidak boleh kosong');
          $("#ket_satuan").focus();
          return false();
        }
        
		$.ajax({
            type    : 'POST',
            url     : "<?php echo base_url(); ?>Master/Barang/simpan_satuan",
            data    : "kd_satuan="+kd_satuan+"&ket_satuan="+ket_satuan,
            cache   : false,
            success : function(data){
                alert(data);
				      location.reload();
            }
        });
	});
});
  


</script>

      <!-- Form Input Satuan Barang -->
      <div class="box box-success collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Satuan</h3>
          <div class="widget-toolbar no-border pull-right">
              <button class="btn btn-block btn-xs btn-success" id="tbh_stok_brg" data-widget="collapse">
                  Tambah Satuan 
              </button>
			  <button class="btn btn-box-tool sr-only" id="min_sat" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <form class="form-horizontal" id="my-form" name="my-form">
          <div class="box-body">
            <div class="form-group">
                <label for="form-field-1" class="col-sm-5 control-label">Kode Satuan</label>
              <div class="col-sm-4">
                <input disabled type="text" class="form-control" name="kd_satuan" id="kd_satuan" placeholder="Kode Satuan" value="<?php echo $kd_sat; ?>">
              </div>                      
            </div>
            <div class="form-group">
              <label for="form-field-1" class="col-sm-5 control-label">Nama Satuan</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="ket_satuan" id="ket_satuan" placeholder="Nama Satuan Barang">
              </div>
            </div>
          </div>
        </form>
          <div class="box-footer">
            <button type="submit" class="btn btn-danger" data-widget="collapse">Batal</button>
            <button type="button" class="btn btn-success pull-right" name="input_sat" id="input_sat">Simpan</button>			
          </div>
      </div>
      <!-- AKhir Form Input Satuan Barang -->
