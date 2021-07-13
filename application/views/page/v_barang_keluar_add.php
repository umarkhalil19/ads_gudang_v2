<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Tambah Barang Keluar</h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                        endif; ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="preview-block">
                                            <!-- <span class="preview-title-lg overline-title">Form Tambah Barang Masuk</span> -->
                                            <?php echo form_open('Barang_Keluar/barang_keluar_temp_add_act'); ?>
                                            <div class="row g-2">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="distributor">Distributor Barang</label>
                                                        <div class="form-control-wrap">
                                                            <select name="distributor" id="distributor" class="form-select form-control" data-search="on" autofocus>
                                                                <option value="default_option">Pilih Distributor</option>
                                                                <?php
                                                                foreach ($distributor->result() as $d) {
                                                                    echo '<option value="' . $d->distributor_id . '">' . $d->distributor_nama . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php echo form_error('distributor', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 showBarang">
                                                    <div class="form-group">
                                                        <label class="form-label" for="kode">Kode Barang</label>
                                                        <div class="form-control-wrap">
                                                            <select name="kode" id="kode" class="form-select form-control" data-search="on" autofocus>
                                                                <option value="default_option">Pilih Barang</option>
                                                                <?php
                                                                foreach ($barang->result() as $b) {
                                                                    echo '<option value="' . $b->barang_kode . '">' . $b->barang_nama . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php echo form_error('kode', '<small><span class="text-danger">', '</span></small>'); ?>
                                                            <div id="show_stok"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="jumlah">Jumlah Barang</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" name="jumlah" id="jumlah" autocomplete="off" value="<?= set_value('jumlah') ?>">
                                                            <?php echo form_error('jumlah', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="diskon">Diskon (Rp)</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" name="diskon" id="diskon" autocomplete="off" value="<?= set_value('diskon') ?>">
                                                            <?php echo form_error('diskon', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                        <small>Ketik tanpa tanda titik (.) cth: 7000</small>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group float-right">
                                                        <button type="submit" class="btn btn-md btn-primary">Tambah Data</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div><!-- .card-preview -->
                            </div>
                            <div class="col-lg-9">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="preview-block">
                                            <div class="row g-2">
                                                <table class="datatable-init table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Satuan Barang</th>
                                                            <th>Harga Satuan</th>
                                                            <th>Jumlah</th>
                                                            <th>Diskon</th>
                                                            <th>Sub Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total = 0;
                                                        foreach ($barang_keluar_temp->result() as $s) {
                                                            $brg = $this->db->query("SELECT barang_nama,barang_satuan,barang_harga_satuan FROM tbl_barang WHERE barang_kode = '$s->temp_kode'")->row();
                                                            $stn = $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id = '$brg->barang_satuan'")->row();
                                                        ?>
                                                            <tr>
                                                                <td><?= $no++; ?></td>
                                                                <td><?= $s->temp_kode; ?></td>
                                                                <td><?= $brg->barang_nama; ?></td>
                                                                <td><?= $stn->satuan_nama; ?></td>
                                                                <td><?= _rupiah($brg->barang_harga_satuan); ?></td>
                                                                <td><?= $s->temp_jumlah; ?></td>
                                                                <td><?= _rupiah($s->temp_diskon) ?></td>
                                                                <td><?= _rupiah(($brg->barang_harga_satuan * $s->temp_jumlah) - $s->temp_diskon) ?></td>
                                                                <?php $total += (($brg->barang_harga_satuan * $s->temp_jumlah) - $s->temp_diskon) ?>
                                                                <td>
                                                                    <a href="<?= base_url('Barang_Keluar/barang_keluar_temp_del/' . $s->temp_id); ?>" class="badge badge-danger">Hapus</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td colspan="7"><b>Total</b></td>
                                                            <td colspan="2"><b><?= _rupiah($total); ?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <?= form_open('Barang_Keluar/barang_keluar_add_act'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="preview-block">
                                            <div class="row g-2">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="invoice">Kode Invoice</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="invoice" id="invoice" autocomplete="off" value="<?= 'SM' . date('Ymd') . date('Hi') ?>" disabled>
                                                            <input type="hidden" class="form-control" name="invoice" id="invoice" autocomplete="off" value="<?= 'SM' . date('Ymd') . date('Hi') ?>">
                                                            <?php echo form_error('invoice', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="tgl">Tanggal Masuk</label>
                                                        <div class="form-control-wrap">
                                                            <input type="date" class="form-control" name="tgl" id="tgl" autocomplete="off" value="<?= set_value('tgl') ?>">
                                                            <input type="hidden" name="total_harga" value="<?= $total; ?>">
                                                            <?php echo form_error('tgl', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="sales">Sales</label>
                                                        <div class="form-control-wrap">
                                                            <select name="sales" id="sales" class="form-control">
                                                                <?php
                                                                foreach ($sales->result() as $s) {
                                                                    echo '<option value="' . $s->salless_id . '">' . $s->salless_nama . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php echo form_error('sales', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="toko">Toko</label>
                                                        <div class="form-control-wrap">
                                                            <select name="toko" id="toko" class="form-control">
                                                                <?php
                                                                foreach ($toko->result() as $t) {
                                                                    echo '<option value="' . $t->toko_id . '">' . $t->toko_nama . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php echo form_error('toko', '<small><span class="text-danger">', '</span></small>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-md btn-primary">Simpan Data</button>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .components-preview -->
        </div>
    </div>
</div>

<script>
    $('#kode').change(function() {
        var kode_brg = $(this).val();
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Barang_Keluar/get_stok',
            data: {
                kode_brg: kode_brg
            },
            success: function(data) {
                $('#show_stok').html(data);
            }
        });
    });

    $('#distributor').change(function() {
        var kode_distributor = $(this).val();
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>/Barang_Keluar/get_barang_by_distributor',
            data: {
                kode_distributor: kode_distributor
            },
            success: function(data) {
                if (data != 'false') {
                    $('.showBarang').html(data);
                } else {
                    alert('barang untuk distributor tersebut tidak di temukan');
                }
            }
        });
    });
</script>