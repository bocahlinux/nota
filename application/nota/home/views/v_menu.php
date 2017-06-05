<?php
if($class=='home'){
    $home = 'class="active"';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = '';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = '';
}elseif($class=='master'){
    $home = '';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = '';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = '';
}elseif($class=='barang'){
    $home = '';
    $master ='class="active treeview"';
    $barang ='class="active"';
    $member ='';
    $transaksi = '';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = '';
}elseif($class=='member'){
    $home = '';
    $master ='class="active treeview"';
    $barang ='';
    $member ='class="active"';
    $transaksi = '';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = '';
}elseif($class=='buat_nota'){
    $home = '';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = 'class="active"';
      $buat_nota = 'class="active"';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = '';
}elseif($class=='nota_jual_alat'){
    $home = '';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = 'class="active"';
      $buat_nota = '';
      $nota_jual_alat = 'class="active"';
	    $nota_service = '';
      $cetak_nota = '';
}elseif($class=='nota_service'){
    $home = '';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = 'class="active"';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = 'class="active"';
      $cetak_nota = '';
}elseif($class=='cetak_nota'){
    $home = '';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = 'class="active"';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = 'class="active"';
}else{
    $home = '';
    $master ='';
    $barang ='';
    $member ='';
    $transaksi = '';
      $buat_nota = '';
      $nota_jual_alat = '';
      $nota_service = '';
      $cetak_nota = '';
}
?>


        <li <?php echo $home;?>>
            <a href="<?php echo base_url();?>">
                <i class="fa fa-dashboard text-aqua"></i>
                    <span>
                        Home
                    </span>
            </a>
        </li>
        <li <?php echo $master;?>>
            <a href="#">
                <i class="fa fa-desktop text-green"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?php echo $barang;?> >
                    <a href="<?php echo base_url();?>stok/barang/"><i class="fa fa-database text-red"></i>Inventory Barang</a>
                </li>
                <li <?php echo $member;?> >
                    <a href="<?php echo base_url();?>home/member/"><i class="fa fa-database text-red"></i>Pelanggan</a>
                </li>
            </ul>
        </li>

        <li <?php echo $transaksi;?> >
          <a href="#">
            <i class="fa fa-tasks text-yellow"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?php echo $buat_nota;?> >
              <a href="<?php echo base_url();?>transaksi/nota_penjualan">
                <i class="fa fa-book text-aqua"></i> Penjualan Barang
              </a>
            </li>

            <li <?php echo $nota_jual_alat;?> >
                <a href="<?php echo base_url();?>transaksi/nota_jual_alat">
                    <i class="fa fa-book text-aqua"></i> Penjualan Spearpart Laptop/PC
                </a>
            </li>
            <li <?php echo $nota_service;?> >
                <a href="<?php echo base_url();?>transaksi/nota_service">
                    <i class="fa fa-book text-aqua"></i> Nota Service Laptop/PC
                </a>
            </li>

            <li <?php echo $cetak_nota;?> >
              <a href="<?php echo base_url();?>transaksi/cetak_Nota">
                <i class="fa fa-print text-aqua"></i> Cetak Nota
              </a>
            </li>
          </ul>
        </li>
