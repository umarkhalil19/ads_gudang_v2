<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Ubah Password</h2>
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
                        <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                        endif; ?>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Form Ubah Password</span>
                                    <?php if ($this->session->userdata('level') == 99) {
                                        echo form_open('admin/change_pass_act');
                                    }else{
                                        echo form_open('owner/change_pass_act');
                                    } ?>
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="pass_lama">Password Sekarang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="pass_lama" id="pass_lama" autocomplete="off" autofocus value="<?= set_value('pass_lama') ?>">
                                                    <?php echo form_error('pass_lama', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="pass_baru">Password Baru</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="pass_baru1" id="pass_baru1" autocomplete="off" value="<?= set_value('pass_baru1') ?>">
                                                    <?php echo form_error('pass_baru1', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="pass_baru">Konfirmasi Password Baru</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="pass_baru2" id="pass_baru2" autocomplete="off" value="<?= set_value('pass_baru2') ?>">
                                                    <?php echo form_error('pass_baru2', '<small><span class="text-danger">', '</span></small>'); ?>
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