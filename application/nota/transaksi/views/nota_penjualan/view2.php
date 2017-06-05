<section class="content">
	<div class="row">
    <div class="col-md-12">
			<div class="box box-warning">
        		<div class="box-header with-border">
        			<h3 class="box-title"><?php echo $judul_box;?></h3>
        		</div>
	        	<div class="box-body">
							<form class="form-horizontal" id="form_transaksi" role="form">
			      		<div class="col-md-8">
				      		<div class="form-group">
										<label class="control-label col-md-3" for="kd_transaksi">Kode Transaksi :</label>
							      <div class="col-md-2">
							      	<input type="text" class="form-control" id="kd_transaksi" name="kd_transaksi" value="<?php echo $kd_tr ?>" readonly="readonly">
										</div>
							    </div>

						    <div class="form-group">
						      <label class="control-label col-md-3"
						      	for="kd_brg">Kode Barang :</label>
						      <div class="col-md-3">
						        <input list="list_barang" class="form-control reset" placeholder="Kode Barang..." name="kd_brg" id="kd_brg" autocomplete="off" onkeypress="showBarang(this.value)" onchange="showBarang(this.value)" autofocus>
	                  <datalist id="list_barang">
	                  	<?php foreach ($barang as $barang): ?>
	                  		<option value="<?php echo $barang->kd_brg ?>"><?= $barang->nm_brg ?></option>
		                  	<?php endforeach ?>
	                  </datalist>
						      </div>
						    </div>

						    <div id="barang">
							    <div class="form-group">
							      <label class="control-label col-md-3"
							      	for="nama_barang">Nama Barang :</label>
							      <div class="col-md-8">
							        <input type="text" class="form-control reset"
							        	name="nama_barang" id="nama_barang"
							        	readonly="readonly">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-md-3"
							      	for="harga_barang">Harga (Rp) :</label>
							      <div class="col-md-3">
							        <input type="text" class="form-control reset"
							        	name="harga_barang" id="harga_barang"
							        	readonly="readonly">
							      </div>
							    </div>
							    <div class="form-group">
							      <label class="control-label col-md-3"
							      	for="qty">Quantity :</label>
							      <div class="col-md-2">
							        <input type="number" class="form-control reset"
							        	autocomplete="off" onchange="subTotal(this.value)"
							        	onkeyup="subTotal(this.value)" id="qty" min="0" max="999"  maxlength="3"
							        	name="qty" placeholder="Isi qty...">
							      </div>
							    </div>
						    </div>
							</form>
							<form class="form-horizontal" id="frmNota" name="frmNota">
						    <div class="form-group">


										<input type="hidden" class="form-control" id="hid_kd_transaksi" name="hid_kd_transaksi" value="<?php echo $kd_tr ?>" readonly="readonly">


						      <label class="control-label col-md-3"
						      	for="sub_total">Sub-Total (Rp):</label>
						      <div class="col-md-3">
						        <input type="text" class="form-control reset"
						        	name="sub_total" id="sub_total"
						        	readonly="readonly">
						      </div>

						    	<div class="col-md-3">
						      		<button type="button" class="btn btn-warning"
						      		id="tambah" onclick="addbarang()">
						      		  <i class="fa fa-cart-plus"></i> Tambah</button>
						    	</div>
						    </div>
			      		</div>

				      	<div class="col-md-4 mb">
							<div class="col-md-12">
							  	<div class="form-group">
							      <label for="total" class="besar">Total (Rp) :</label>
							      	<input type="text" class="form-control input-lg"
						        	name="total" id="total" placeholder="0"
						        	readonly="readonly"  value="<?= number_format(
			                    	$this->cart->total(), 0 , '' , '.' ); ?>">
							    </div>
							    <div class="form-group">
							      <label for="bayar" class="besar">Bayar (Rp) :</label>
							        <input type="text" class="form-control input-lg uang"
							        	name="bayar" placeholder="0" autocomplete="off"
							        	id="bayar" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);showKembali(this.value)" >
							    </div>
							    <div class="form-group">
							      <label for="kembali" class="besar">Kembali (Rp) :</label>
							      	<input type="text" class="form-control input-lg"
						        	name="kembali" id="kembali" placeholder="0"
						        	readonly="readonly">
							    </div>
								<div class="form-group">
									<button type="button" class="btn btn-success" id="simpan" name="simpan" data-toggle="tooltip" title="Simpan Nota di Database" data-placement="bottom">
										<i class="fa fa-save"></i> Simpan
									</button>
									<button type="button" id="cetak" name="cetak">
									 <a href="<?php echo base_url();?>transaksi/nota_penjualan/cetak_penjualan" target="_blank" class="btn btn-info"  data-toggle="tooltip" title="Cetak Nota" data-placement="bottom" >
										<i class="fa fa-print"></i> Cetak
									</a>
									</button>
								</div>
							</div>
				      	</div>
			      	</form>
						</div>
						</div>
						<div class="box box-info">
	        		<div class="box-header with-border">
	        			<h3 class="box-title">Detail Barang</h3>
								<div class="pull-right box-tools">
				          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
				        </div>
	        		</div>
							<div class="box-body">
				      	<table id="table_transaksi" class="table table-striped table-bordered table-hover small table-responsive" cellspacing="0" width="100%">
									<thead>
									 	<tr>
										   	<th>No</th>
										   	<th>Kode Barang</th>
										   	<th>Nama Barang</th>
										   	<th>Harga</th>
										   	<th>Quantity</th>
										   	<th>Sub-Total</th>
										   	<th>Aksi</th>
									 	</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
		</div>
	</div>
</section>

<script type="text/javascript">

	function showBarang(str)
	{
	    if (str == "") {
	        $('#nama_barang').val('');
	        $('#harga_barang').val('');
	        $('#qty').val('');
	        $('#sub_total').val('');
	        $('#reset').hide();


	        return;
	    } else {
	      if (window.XMLHttpRequest) {
	          // code for IE7+, Firefox, Chrome, Opera, Safari
	           xmlhttp = new XMLHttpRequest();


	      } else {
	          // code for IE6, IE5
	          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");


	      }
	      xmlhttp.onreadystatechange = function() {
	           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	              document.getElementById("barang").innerHTML =
	              xmlhttp.responseText;
								$('#qty').focus();

	          }
	      }
	      xmlhttp.open("GET", "<?php echo base_url('transaksi/nota_penjualan/getbarang')?>/"+str,true);
	      xmlhttp.send();
				$('#qty').focus();

	    }
	}

	function subTotal(qty)
	{
		var harga = $('#harga_barang').val().replace(".", "").replace(".", "");
		$('#sub_total').val(convertToRupiah(harga*qty));
	}

	function convertToRupiah(angka)
	{
	    var rupiah = '';
	    var angkarev = angka.toString().split('').reverse().join('');
	    for(var i = 0; i < angkarev.length; i++)
	      if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	    return rupiah.split('',rupiah.length-1).reverse().join('');
	}

	var table;
    $(document).ready(function() {
			$("#simpan").click(function(){

        var string = $("#frmNota").serialize();



        if($("#total").val()=='0'){
            $.gritter.add({
                title: 'Peringatan..!!',
                text: 'Belum ada barang yang dibeli',
                class_name: 'gritter-light'
            });
						$("#kd_brg").focus();
						return false();
					}




				//window.open("about:blank", "_blank");
        $.ajax({
            type    : 'POST',
            url     : "<?php echo site_url(); ?>/transaksi/nota_penjualan/simpan_dt_penjualan",
            data    : string,
            cache   : false,
						dataType: "json",
            success : function(data){
                /*$.gritter.add({
                    title: 'Info..!!',
                    text: data,
                    class_name: 'gritter-info'
                });

								*/
								if (data == 0){
									$.gritter.add({
			                title: 'Peringatan..!!',
			                text: 'Harus ada uang yang dibayar'
			            });
									$("#bayar").focus();
			            return false();
						     }
						     else{
									 $.gritter.add({
	                     title: 'Info..!!',
	                     text: 'Data Berhasil Disimpan',
	                     class_name: 'gritter-info'
	                 });
									 //alert(data.kd_tr2);
									 //window.open("<?php //echo base_url().'transaksi/nota_penjualan/cetak_penjualan/'data.kd_tr2;?>, "", "width=800,height=600");
									 window.open('<?php echo base_url();?>transaksi/nota_penjualan/cetak_penjualan/'+$("#hid_kd_transaksi").val(),"", "top=200,left=300,width=800,height=400");

									 reload_table();
									 $("#kd_brg").focus();
									 $('#total').val('0');
									 $('#bayar').val('0');
									 $('#kembali').val('0');
									 $('#stok_angka').hide();
									 //location.reload();

									 $.ajax({
					 					type	: 'POST',
					 					url   : "<?php echo site_url(); ?>/transaksi/nota_penjualan/getKode",
					 					data	: string,
					 					cache	: false,
					 					dataType: "json",
					 					success	: function(data){
					 						//$("#kd_transaksi").val('');
					 						$("#kd_transaksi").val(data.kd_tr);
					 						$("#hid_kd_transaksi").val(data.kd_tr);
					 						//$("#nama").val(data.nama);
					 					}
					 				});
						     }
            }
        });



    });

      showKembali($('#bayar').val());
      table = $('#table_transaksi').DataTable({
        paging: false,
        "info": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables'
        // server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url ('transaksi/nota_penjualan/ajax_list_transaksi')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { "width": "2%", "targets": 0 },
        { "width": "5%", "targets": 1 },
        { "width": "35%", "targets": 2 },
        { "width": "10%", "targets": 3 },
        { "width": "5%", "targets": 4 },
        { "width": "10%", "targets": 5 },
        { "width": "5%", "targets": 6 },
        { "targets": [ 0,1,2,3,4,5,6 ], "orderable": false,},
      ],
      });
    });

    function reload_table()
    {
		table.ajax.reload(null,false); //reload datatable ajax
    }

		function checkSubmit(e)
		{
			if(e && e.keyCode == 13)
			{
      	addbarang();
				$('#stok_angka').hide();
	   	}
		}

		function addbarang()
    {
        var kd_brg = $('#kd_brg').val();
        var qty = $('#qty').val();
        if (kd_brg == '') {
          $('#kd_brg').focus();
        }else if(qty == ''){
          $('#qty').focus();
        }else{
       // ajax adding data to database
          $.ajax({
            url : "<?php echo base_url ('transaksi/nota_penjualan/addbarang')?>",
            type: "POST",
            data: $('#form_transaksi').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //reload ajax table
							 $('#stok_angka').hide();
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
          showTotal();
          showKembali($('#bayar').val());
          $('#kd_brg').focus();
          //mereset semua value setelah btn tambah ditekan
          $('.reset').val('');
        };
    }

    function deletebarang(id,sub_total)
    {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo base_url ('transaksi/nota_penjualan/deletebarang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

          var ttl = $('#total').val().replace(".", "");
          $('#total').val(convertToRupiah(ttl-sub_total));
          showKembali($('#bayar').val());
    }

    function showTotal()
    {
    	var total = $('#total').val().replace(".", "").replace(".", "");
    	var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");
    	$('#total').val(convertToRupiah((Number(total)+Number(sub_total))));
  	}

  	//maskMoney
	$('.uang').maskMoney({
		thousands:'.',
		decimal:',',
		precision:0
	});

	function showKembali(str)
  	{
	    var total = $('#total').val().replace(".", "").replace(".", "");
	    var bayar = str.replace(".", "").replace(".", "");
	    var kembali = bayar-total;

	    $('#kembali').val(convertToRupiah(kembali));
	    if (kembali >= 0) {
	      $('#simpan').removeAttr("enabled");
	    }else{
	      $('#simpan').attr("enabled","enabled");
	    };

	    if (total == '0') {
	      $('#simpan').attr("enabled","enabled");
	    };
  	}

		//========function angka to rupiah========//
		function tandaPemisahTitik(b)
  {
    var _minus = false;
    if (b<0) _minus = true;
    b = b.toString();
    b=b.replace(".","");
    b=b.replace("-","");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--){
    j = j + 1;
    if (((j % 3) == 1) && (j != 1)){
    c = b.substr(i-1,1) + "." + c;
    } else {
    c = b.substr(i-1,1) + c;
    }
    }
    if (_minus) c = "-" + c ;
    return c;
  }

  function numbersonly(ini, e)
  {
    if (e.keyCode>=49)
    {
      if(e.keyCode<=57)
      {
        a = ini.value.toString().replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
        ini.value = tandaPemisahTitik(b);
        return false;
      }
      else if(e.keyCode<=105)
      {
        if(e.keyCode>=96)
        {
          //e.keycode = e.keycode - 47;
          a = ini.value.toString().replace(".","");
          b = a.replace(/[^\d]/g,"");
          b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
          ini.value = tandaPemisahTitik(b);
          //alert(e.keycode);
          return false;
        }
        else
        {
          return false;
        }
      }
      else
      {
        return false;
      }
    }
    else if (e.keyCode==48)
    {
      a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
      b = a.replace(/[^\d]/g,"");
      if (parseFloat(b)!=0)
      {
        ini.value = tandaPemisahTitik(b);
        return false;
      }
      else
      {
        return false;
      }
    }
    else if (e.keyCode==95)
    {
      a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
      b = a.replace(/[^\d]/g,"");
      if (parseFloat(b)!=0)
      {
        ini.value = tandaPemisahTitik(b);
        return false;
      }
      else
      {
        return false;
      }
    }
    else if (e.keyCode==8 || e.keycode==46)
    {
      a = ini.value.replace(".","");
      b = a.replace(/[^\d]/g,"");
      b = b.substr(0,b.length -1);
      if (tandaPemisahTitik(b)!="")
      {
        ini.value = tandaPemisahTitik(b);
      }
      else
      {
        ini.value = "";
      }
      return false;
    }
    else if (e.keyCode==9)
    {
      return true;
    }
    else if (e.keyCode==17)
    {
      return true;
    }
    else
    {
      //alert (e.keyCode);
      return false;
    }
  }

	</script>

	<script src="<?php echo base_url('assets/admin_lte/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/admin_lte/plugins/datatables/dataTables.bootstrap.js')?>"></script>
	<script src="<?= base_url('assets/maskMoney/jquery.maskMoney.min.js') ?>"></script>
