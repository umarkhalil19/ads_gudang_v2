<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Edit Distributor</h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="nk-block-des">
                                    <p>Form ini digunakan untuk merubah data distributor</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Form Edit Distributor</span>
                                    <?php echo form_open('distributor/distributor_update'); ?>
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Nama Distributor</label>
                                                <div class="form-control-wrap">
                                                    <input type="hidden" name="id" value="<?= $distributor->distributor_id ?>">
                                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" autofocus value="<?= $distributor->distributor_nama ?>">
                                                    <?php echo form_error('nama', '<small><span class="text-danger">', '</span></small>'); ?>
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