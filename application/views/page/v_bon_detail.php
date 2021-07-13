<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Detail Bon / Faktur</h3>
                        <div class="nk-block-des">
                            <p>Data Detail Bon / Faktur</p>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Detail Transaksi</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">
                        <div class="row g-2">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Tanggal Transaksi</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= TanggalIndo($invoice->invoice_tgl) ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Nomor Invoice</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= $invoice->invoice_kode ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Toko</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">:
                                        <?php
                                        $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$invoice->invoice_toko'")->row();
                                        echo $toko->toko_nama; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Sales</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">:
                                        <?php
                                        $sales = $this->db->query("SELECT salless_nama FROM tbl_salless WHERE salless_id='$invoice->invoice_salless'")->row();
                                        echo $sales->salless_nama; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Total Transaksi</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= _rupiah($invoice->invoice_total_harga) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Detail Riwayat Pembayaran</h6>
                            </div>
                            <a href="" class="btn btn-warning float-right"><em class="icon ni ni-printer-fill"></em> Cetak Bon Kredit</a>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">
                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Total</th>
                                    <th>Dibayar</th>
                                    <th>Tanggal Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($bon->result() as $s) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->kode_invoice; ?></td>
                                        <td><?= _rupiah($s->bon_total); ?></td>
                                        <td><?= _rupiah($s->bon_dibayar); ?></td>
                                        <td>
                                            <?php
                                            if ($s->bon_dibayar == 0) {
                                                echo '-';
                                            } else {
                                                echo TanggalIndo($s->bon_tgl);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Pembayaran</h6>
                            </div>
                        </div>
                    </div>
                    <?php
                    $bon = $this->db->query("SELECT * FROM tbl_bon_kredit WHERE kode_invoice='$invoice->invoice_kode' AND bon_dibayar=0 LIMIT 1");
                    ?>
                    <?= form_open('bon/bon_proses'); ?>
                    <div class="container mt-3 mb-3">
                        <div class="row g-2">
                            <?php if ($bon->num_rows() >= 1) {
                                $bon_bayar = $bon->row(); ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="invoice">Total Bon</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="total" id="total" autocomplete="off" value="<?= _rupiah($bon_bayar->bon_total) ?>" disabled>
                                            <input type="hidden" class="form-control" name="total" id="total" autocomplete="off" value="<?= $bon_bayar->bon_total ?>">
                                            <input type="hidden" name="no_urut" value="<?= $bon_bayar->bon_urut ?>">
                                            <input type="hidden" name="id" value="<?= $bon_bayar->bon_id ?>">
                                            <input type="hidden" name="invoice" value="<?= $bon_bayar->kode_invoice ?>">
                                            <?php echo form_error('invoice', '<small><span class="text-danger">', '</span></small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="tgl">Dibayar</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="bayar" id="bayar" autocomplete="off" value="<?= set_value('bayar') ?>" autofocus>
                                            <?php echo form_error('bayar', '<small><span class="text-danger">', '</span></small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-md btn-primary">Proses</button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <p align="center">Tidak transaksi yang dapat diproses</p>
                            <?php } ?>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->