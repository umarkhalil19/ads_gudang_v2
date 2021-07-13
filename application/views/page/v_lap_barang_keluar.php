<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Laporan Barang Keluar</h3>
                        <div class="nk-block-des">
                            <p>Data Laporan Barang Keluar</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>

                <div class="card card-bordered card-full">
                    <div class="container mt-3 mb-3">
                        <?= form_open('laporan/barang_keluar'); ?>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Dari tanggal</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="dari_tgl">
                                    </div>
                                    <div class="form-note">Laporan akan ditampilkan dari tanggal ini</div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Hingga tanggal</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="hingga_tgl">
                                    </div>
                                    <div class="form-note">Laporan akan ditampilkan hingga tanggal ini</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" style="color: white;">---------</label>
                                    <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>


                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Barang Keluar</h6>
                            </div>
                            <?php if ($barang_keluar->num_rows() > 0) { ?>
                                <?= form_open('laporan/barang_keluar_cetak', ['target' => '_blank']) ?>
                                <input type="hidden" name="dari_tgl" value="<?= $dari_tgl ?>">
                                <input type="hidden" name="hingga_tgl" value="<?= $hingga_tgl ?>">
                                <div class="card-tools">
                                    <button type="submit" class="btn btn-primary btn-sm">Cetak</button>
                                </div>
                                <?= form_close(); ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Invoice</th>
                                    <th>Sales</th>
                                    <th>Toko</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($barang_keluar->num_rows() > 0) {
                                $no = 1;
                                $total = 0;
                                foreach ($barang_keluar->result() as $s) {
                                    $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$s->invoice_toko'")->row();
                                    $sales = $this->db->query("SELECT salless_nama FROM tbl_salless WHERE salless_id='$s->invoice_salless'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->invoice_kode; ?></td>
                                        <td><?= $sales->salless_nama; ?></td>
                                        <td><?= $toko->toko_nama; ?></td>
                                        <?php $total += $s->invoice_total_harga; ?>
                                        <td><?= _rupiah($s->invoice_total_harga); ?></td>
                                        <td><?= _tglIndo($s->invoice_tgl) ?></td>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td><b>Total</b></td>
                                    <td><b>: <?= _rupiah($total) ?></b></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->