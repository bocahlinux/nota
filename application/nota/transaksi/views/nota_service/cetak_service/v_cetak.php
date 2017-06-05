<style>
  #head
  {
    background: #007d1a !important;color: white;
  }
  #total
  {
    background: #f8eec6 !important;color: black;
    padding:10px;
    line-height: 20px;
    vertical-align: top;

    border-bottom: 1px solid #DDD;
  }

</style>
<table class="header-container" width="750">
  <tbody>
    <tr>
      <td >
        <h1 style="font-size: 1.6em;float:left;margin:0.3em 0 0 0;padding:0;">
          <img src="<?php echo base_url();?>assets/img/logo.jpg">
        </h1>
        <br><br><br><br><br><br><br>
        <strong>
          Fotocopy, Warnet, Service Laptop & Komputer, <br>Penjualan ATK, Jilid, Laminating, Editing Skripsi
        </strong>
      </td>
      <td style="text-align: right;margin:0;padding:0;float:right;">
        <strong>
          <a style="color:green;text-decoration:none;" href="javascript:window.print()">
            <span style="color:green;text-decoration:none;">
              Cetak
              <img src="<?php echo base_url();?>assets/img/icon/print.png" alt="Print" />
            </span>
          </a>
        </strong>
        <br><br><br>
        <img src="<?php echo base_url();?>transaksi/nota_penjualan/barcode_cetak_penjualan/<?php echo $kd_tr;?>">
      </td>
      <td>
        &nbsp;
      </td>
    </tr>
    <tr class="invoice-separator">
      <td colspan="2">
        <div style="margin: 5px 0 5px;border: 0;border-top: 1px solid #EEE;border-bottom: 1px solid white;">
        </div>
      </td>
    </tr>
  </tbody>
</table>
    <table cellspacing="0" cellpadding="5" border="0" width="750" bgcolor="#FAF9F9" style="font-family: sans-serif; color:#444; margin:10px 0 0;-webkit-text-size-adjust: none;border: 1px solid #EEE;">
			<thead id="head" name="head">
        <tr>
            <th style="padding:10px" width="5px">No</th>
            <th width="10%">Kode</th>
            <th width="35px" style="text-align:left">Nama Barang</th>
            <th width="25px">Harga</th>
            <th width="5px">Quantity</th>
            <th width="2px">Sub-Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach($this->cart->contents() as $items):

        echo '
        <tr>
          <th style="padding:10px">'.$no++.'</th>
          <th>'.$items['id'].'</th>
          <th style="text-align:left">'.$items['name'].'</th>
          <th>Rp. ' . number_format( $items['price'],0,'','.').'</th>
          <th>'.$items['qty'].'</th>
          <th>
            Rp. ' . number_format( $items['subtotal'],0,'','.').
          '</th>
        </tr>
          ';
          endforeach  ?>
        <tr id="total" name="total">
            <th colspan="5" style="text-align:right"><strong>Total Pembayaran</strong></th>
            <th><?php echo 'Rp. '.number_format(
                  $this->cart->total(), 0 , '' , '.' );?> </th>
        </tr>
      </tbody>
    </table>
  </div>
</div>
