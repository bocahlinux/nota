
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
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs bg-aqua-gradient">
      <li class="active bg-yellow-gradient"><a href="#tab_1" data-toggle="tab">Barang</a></li>
      <li class="bg-yellow-gradient"><a href="#tab_2" data-toggle="tab">Biaya Service</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        <div class="row">
          <div class="col-md-8">
            <?php $this->view('stok/v_barang');?>
          </div>

          <div class="col-md-4">
            <?php $this->view('stok/v_satuan');?>
          </div>
        </div>
      </div>

      <div class="tab-pane" id="tab_2">
        <div class="row">
          <div class="col-md-12">
            <?php $this->view('stok/v_service');?>
          </div>
        </div>
      </div>
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
