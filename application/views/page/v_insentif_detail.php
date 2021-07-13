<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="nk-block-head-content">
                                <h3 class="title">Detail Insentif Sales</h3>
                                <div class="nk-block-des">
                                    <p>Data Detail Insentif Sales</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?= form_open('insentif/insentif_cetak'); ?>
                            <input type="hidden" name="bulan" value="<?= $bulan ?>">
                            <input type="hidden" name="tahun" value="<?= $tahun ?>">
                            <input type="hidden" name="sales_id" value="<?= $sales_id ?>">
                            <button type="submit" class="btn btn-block btn-primary">Cetak</button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Data Sales</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">
                        <div class="row g-2">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="nama">Nama Lengkap</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= $sales->salless_nama ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="alamat">Alamat</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= $sales->salless_alamat ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="no_hp">Nomor HP</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">:
                                        <?= $sales->salles_no_hp ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="total">Total Transaksi</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <b>
                                        <p class="form-label" id="show_total"></p>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Data Detail Invoice Barang</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Invoice</th>
                                    <th>Toko</th>
                                    <th>Tanggal</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($invoice->result() as $i) {
                                    $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$i->invoice_toko'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $i->invoice_kode; ?></td>
                                        <td><?= $toko->toko_nama; ?></td>
                                        <td><?= TanggalIndo($i->invoice_tgl); ?></td>
                                        <td><?= _rupiah($i->invoice_total_harga); ?></td>
                                        <?php $total += $i->invoice_total_harga; ?>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td id="_total"><b><?= _rupiah($total); ?><b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

<script>
    $(document).ready(function() {
        $('#show_total').text(': ' + $('#_total')[0].textContent);
    });
</script>