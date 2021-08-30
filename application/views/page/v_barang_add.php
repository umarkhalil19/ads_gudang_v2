<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Tambah Barang</h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="nk-block-des">
                                    <p>Form ini digunakan untuk menambah data Barang</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Form Tambah Barang</span>
                                    <?php echo form_open('barang/barang_add_act'); ?>
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <?php
                                                $cek =  autoCodeBarang('barang_kode', 'tbl_barang', '');
                                                $kode = 'SMBRG' . $cek;
                                                ?>
                                                <label class="form-label" for="kegiatan">Kode Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="kode" id="kode" autocomplete="off" autofocus value="<?= $kode; ?>" disabled>
                                                    <input type="hidden" class="form-control" name="kode" id="kode" autocomplete="off" autofocus value="<?= $kode; ?>">
                                                    <?php echo form_error('kode', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Nama</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= set_value('nama') ?>">
                                                    <?php echo form_error('nama', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Satuan Barang</label>
                                                <div class="form-control-wrap">
                                                    <select name="satuan" id="satuan" class="form-control">
                                                        <?php
                                                        foreach ($satuan->result() as $stn) {
                                                            echo '<option value="' . $stn->satuan_id . '">' . $stn->satuan_nama . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php echo form_error('satuan', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Harga Satuan</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="harga" id="harga" autocomplete="off" value="<?= set_value('harga') ?>">
                                                    <?php echo form_error('harga', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="sks_bkd">Jumlah Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="jumlah" id="jumlah" autocomplete="off" value="<?= set_value('jumlah') ?>">
                                                    <?php echo form_error('jumlah', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="distributor">Distributor</label>
                                                <div class="form-control-wrap">
                                                    <select name="distributor" id="distributor" class="form-control">
                                                        <?php
                                                        foreach ($distributor->result() as $stn) {
                                                            echo '<option value="' . $stn->distributor_id . '">' . $stn->distributor_nama . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php echo form_error('distributor', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group float-right">
                                                <button type="submit" class="btn btn-md btn-primary">Simpan Data</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>