<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">

                            <h2 class="nk-block-title fw-normal">Edit Barang Barang</h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="nk-block-des">
                                    <p>Form ini digunakan untuk merubah data Barang</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Form Edit Barang</span>

                                    <?php echo form_open('barang/barang_update'); ?>
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Kode Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="kode" id="kode" autocomplete="off" autofocus value="<?= $barang->barang_kode; ?>" disabled>
                                                    <input type="hidden" class="form-control" name="kode" id="kode" autocomplete="off" autofocus value="<?= $barang->barang_kode; ?>">
                                                    <?php echo form_error('kode', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Nama</label>
                                                <div class="form-control-wrap">

                                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= $barang->barang_nama; ?>">

                                                    <?php echo form_error('nama', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="kegiatan">Satuan Barang</label>
                                                <div class="form-control-wrap">

                                                    <?php
                                                    $a =  $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id='$barang->barang_satuan'")->row();
                                                    ?>
                                                    <select name="satuan" id="satuan" class="form-control">
                                                        <option value="<?= $barang->barang_satuan ?>"><?= $a->satuan_nama ?></option>
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

                                                    <input type="number" class="form-control" name="harga" id="harga" autocomplete="off" value="<?= $barang->barang_harga_satuan; ?>">

                                                    <?php echo form_error('harga', '<small><span class="text-danger">', '</span></small>'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="sks_bkd">Jumlah Barang</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="jumlah" id="jumlah" autocomplete="off" value="<?= $barang->barang_jumlah; ?>">
                                                    <?php echo form_error('jumlah', '<small><span class="text-danger">', '</span></small>'); ?>
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