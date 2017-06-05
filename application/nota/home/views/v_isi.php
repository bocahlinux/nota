<script src="<?php echo base_url();?>assets/admin_lte/dist/js/pages/dashboard.js"></script>

<section class="content">
    <div class="row">
        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-purple-gradient">
                <div class="inner">
                    <h3><?php echo $stok_brg; ?></h3>
                    <p>Barang dan Satuan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                    <a href="<?php echo base_url();?>stok/barang" class="small-box-footer">More info
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
        </div>

        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-green-gradient">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Barang Terjual</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <h3>44</h3>
                    <p>Nota Penjualan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="<?php echo base_url();?>transaksi/nota_penjualan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-teal-gradient">
                <div class="inner">
                    <h3>44</h3>
                    <p>Nota Service</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="<?php echo base_url();?>transaksi/nota_penjualan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-maroon-gradient">
                <div class="inner">
                    <h3>65</h3>
                    <p>Cetak Nota</p>
                </div>
                <div class="icon">
                  <i class="fa fa-windows"></i>
                </div>
                    <a href="<?php echo base_url();?>transaksi/cetak_Nota" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-xs-6">
            <div class="small-box bg-red-gradient">
                <div class="inner">
                    <h3>65</h3>
                    <p>xXx</p>
                </div>
                <div class="icon">
                  <i class="fa fa-windows"></i>
                </div>
                    <a href="<?php echo base_url();?>transaksi/cetak_Nota" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <section class="col-lg-5 connectedSortable">
            <div class="box box-solid bg-aqua-gradient">
                <div class="box-header">
                    <i class="fa fa-calendar"></i>
                        <h3 class="box-title">Kalender</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                </div>
                <div class="box-body no-padding">
                    <div id="calendar" style="width: 100%"></div>
                </div>
            </div>
        </section>

        <section class="col-lg-7 connectedSortable">
            <div class="box box-primary">
                <div class="box-header with-border bg-aqua-gradient">
                    <i class="fa fa-th-large"></i>
                        <h3 class="box-title">Setting Aplikasi</h3>
                            <div class="widget-toolbar no-border pull-right" style="margin-left:5px">
                                <button class="btn btn-block btn-xs btn-info" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                </div>

                <div class="box-body bg-yellow-gradient">
                    <form action="#" id="form_barang" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama Aplikasi</label>
                                <div class="col-md-4">
                                    <input disabled name="nm_app" id="nm_app" maxlength="15" placeholder="Nama Aplikasi" class="form-control" type="text" value="<?php echo $setting->judul_app;?>">
                                    <span class="help-block"></span>
                                </div>
                                <button class="btn btn-xs btn-primary" onclick="edit_judul()">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Contact Person</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input disabled name="telp" id="telp"  placeholder="Nomor Telp" class="form-control" type="text" maxlength="11" value="<?php echo $setting->telp;?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mobile-phone"></i>
                                        </div>
                                        <input disabled name="hp" id="hp" type="text" placeholder="Nomor Handphone" class="form-control" data-inputmask='"mask": "(62) 852-9999"' data-mask maxlength="12" value="<?php echo $setting->hp;?>">
                                    </div>
                                </div>
                                    <button class="btn btn-xs btn-primary" onclick="edit_hp()">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                    <div class="col-md-5">
                                        <textarea disabled class="form-control" rows="3" name="alamat" id="alamat" placeholder="Enter Alamat ..."><?php echo $setting->alamat_app;?></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                <button class="btn btn-xs btn-primary" onclick="edit_alamat()">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-5">
                                        <input disabled name="email" id="email" placeholder="email" class="form-control" type="text" maxlength="35"value="<?php echo $setting->email;?>">
                                        <span class="help-block"></span>
                                    </div>
                                <button class="btn btn-xs btn-primary" onclick="edit_email()">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>
