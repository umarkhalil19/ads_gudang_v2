<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Tambah Salesman</h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="nk-block-des">
                                    <p>Form ini digunakan untuk menambah data Salesman</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Form Tambah Salesman</span>
                                    <?php echo form_open('sales/sales_add_act'); ?>
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Nama</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" autofocus value="<?= set_value('nama') ?>">
                                                    <?php echo form_error('nama', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">No. Hp</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="no_hp" id="no_hp" autocomplete="off" value="<?= set_value('no_hp') ?>">
                                                    <?php echo form_error('no_hp', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="sks_bkd">Alamat</label>
                                                <div class="form-control-wrap">
                                                    <textarea name="alamat" id="alamat" rows="5" class="form-control"><?= set_value('alamat') ?></textarea>
                                                    <?php echo form_error('alamat', '<small><span class="text-danger">', '</span></small>'); ?>
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