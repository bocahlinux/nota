
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
    <div class="col-md-12">
      <?php $this->view('penjualan/v_penjualan');?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <?php $this->view('service/v_service');?>
    </div>
  </div>

  
</section>


<script src="<?php echo base_url('assets/admin_lte\plugins\datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin_lte\plugins\datatables/dataTables.bootstrap.js')?>"></script>
