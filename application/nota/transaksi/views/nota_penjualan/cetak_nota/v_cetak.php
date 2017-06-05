
<html lang="en">
	<head>
        <meta charset="utf-8" />
		<title>NOTA BON</title>
  </head>

<style>
  <!--
   @page {
      size:A5;
      margin-left: 0.5cm;
      margin-right: 0.5cm;
      margin-top: 0.5cm;
    }
    @media print
    {
      html, body {
        height: 210mm;
	width: 148.5mm;
	}
      /* ... the rest of the rules ... */
    }
    h1 { page-break-before : right }
    h2 { page-break-after : avoid }
   -->

  #head
  {
    background: #007d1a !important;color: white;
    background: #5aff5a !important;color: black;
    color:#444;
  }
  #top
  {
    border-top:1px solid #444;
    border-bottom:1px solid #444;
    padding-top: 5px;
    padding-bottom: 5px;
  }
  #total
  {
    border-top:1px solid #444;
    background: #F2F3F4 !important;color: #444;
    padding:0px;
    line-height: 20px;
    vertical-align: top;
  }
  #cash
  {
    background: #F2F3F4 !important;color: #444;
    padding:0px;
    line-height: 20px;
    vertical-align: top;
  }
  #kembali
  {
    background: #F2F3F4 !important;color: #444;
    padding:0px;
    line-height: 20px;
    vertical-align: top;
  }

</style>
<style type="text/css" media="print">
   table thead
   {
    display: table-header-group;
   }
</style>
<body>
<?php
foreach($dt_trans->result_array() as $d):
  endforeach  ?>
<table class="header-container" width="750">
  <tbody>
    <tr>
      <td>
        <h1 style="float:left;margin:0;padding:0;">
          <img src="<?php echo base_url();?>assets/img/logo.jpg" width="80%">
        </h1>
      </td>
      <td>
        <div style="font-size:12px;padding-top:20px">
          <!-- Kepada : <?php echo $d['kd_pelanggan'];?> -->
        </div>
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
        <div style="font-size:12px;padding-top:20px">
          Tanggal    : <?php echo date("d F Y", strtotime($d['tgl_transaksi']));?>
        </div>
        <img style="width:70%" src="<?php echo base_url();?>transaksi/nota_penjualan/barcode_cetak_penjualan/<?php echo $kd_tr;?>">
      </td>
      <td>
        &nbsp;
      </td>
    </tr>
    <tr>
      <td>
      <b style="font-size:13px;color:#444">
        Fotocopy, Warnet, Service Laptop & Komputer, <br>Penjualan ATK, Jilid, Laminating, Editing Skripsi
      </b>
</td>
	<td>
      </td>
<td style="text-align: right;margin:0;padding-top:10px;float:right;">

<b> NOTA ASLI </b>


    </td>
    </tr>

  </tbody>
</table>
    <table cellspacing="0" cellpadding="2" border="0" width="750" bgcolor="#FAF9F9" style="font-family: sans-serif; color:#444;-webkit-text-size-adjust: none;border: 0px solid #EEE;font-size:11px">
			<thead id="head" name="head">
        <tr>
            <th id="top" style="padding-left:10px" width="5px">No</th>
            <th id="top" width="10%">Kode</th>
            <th id="top" width="25px" style="text-align:left">Nama Barang</th>
            <th id="top" colspan="2">Harga</th>
            <th id="top" style="text-align:right" width="50px">Qty</th>
            <th id="top" style="text-align:center;padding-right:10px" colspan="2">Sub Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        if (count($dt_trans->result_array()) <=3)
        {
          foreach($dt_trans->result_array() as $items)
          {
          echo '
          <tr>
          <th style="padding-bottom:10px"></th>
          </tr>
          <tr>
            <th style="padding:1px">'.$no++.'</th>
            <th>'.$items['kd_brg'].'</th>
            <th style="text-align:left">'.$items['nm_brg'].'</th>
            <th width="20px"> Rp. </th>
            <th width="50px" style="text-align:right">'. number_format( $items['harga'],0,'','.').'</th>
            <th style="text-align:right">'.$items['jumlah'].'</th>
            <th width="30px" style="text-align:right">
              Rp.
            </th>
            <th width="45px" style="text-align:right;padding-right:10px">
              '.number_format( $items['harga']*$items['jumlah'],0,'','.').'
            </th>
          </tr>
          <tr>
            <th style="padding-bottom:5px"></th>
          </tr>
            ';
          }
        }else {


        foreach($dt_trans->result_array() as $items)
        {

        echo '
        <tr>
          <th style="padding:1px">'.$no++.'</th>
          <th>'.$items['kd_brg'].'</th>
          <th style="text-align:left">'.$items['nm_brg'].'</th>
          <th width="20px"> Rp. </th>
          <th width="50px" style="text-align:right">'. number_format( $items['harga'],0,'','.').'</th>
          <th style="text-align:right">'.$items['jumlah'].'</th>
          <th width="30px" style="text-align:right">
            Rp.
          </th>
          <th width="45px" style="text-align:right;padding-right:10px">
            '.number_format( $items['harga']*$items['jumlah'],0,'','.').'
          </th>
        </tr>
          ';
        }  }?>
        </tbody>
        <tfoot>
        <tr>
          <tr>
            <th style="padding-bottom:0px"></th>
          </tr>
          <td id="total" colspan="3" rowspan="3" style="text-align:left">
            <ul type="Circle">
              <li>Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.</li>
              <li>Pembayaran dianggap LUNAS dan sah bila telah dicap.</li>
            </ul>
          </td>
            <td id="total" name="total" colspan="3" style="text-align:right">
              <strong>Total</strong>
            </td>
            <td id="total" name="total" width="25px" style="text-align:right">
              <b>Rp.</b>
            </td>
            <td id="total" name="total" width="45px" style="text-align:right;padding-right:10px">
              <b><?php echo number_format($items['total'], 0 , '' , '.' );?></b>
            </td>
        </tr>
        <tr id="cash" name="cash">
          <td colspan="3" style="text-align:right"><strong>Cash</strong></td>
          <td width="30px" style="text-align:right">
            <b>Rp.</b>
          </td>
          <td width="45px" style="text-align:right;padding-right:10px">
            <b><?php echo number_format($items['bayar'], 0 , '' , '.' );?></b>
          </td>
        </tr>
        <tr>
          <td  id="kembali" name="kembali" colspan="3" style="text-align:right;vertical-align:top">
            <b>Kembali</b>
          </td>
          <td  id="kembali" name="kembali" width="30px" style="text-align:right">
            <b>Rp.</b>
          </td>
          <td  id="kembali" name="kembali" width="45px" style="text-align:right;padding-right:10px">
            <b><?php echo number_format($items['bayar']-$items['total'], 0 , '' , '.' );?></b>
          </td>
        </tr>
      </tfoot>
    </table>
 </div>
</div>

</body>
</html>
