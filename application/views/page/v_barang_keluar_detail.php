<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Detail Barang Keluar</h3>
                        <div class="nk-block-des">
                            <p>Data Detail Barang Keluar</p>
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
                                <h6 class="title">Tabel Data Detail Barang Keluar</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($keluar->result() as $s) {
                                    $nama = $this->db->query("SELECT barang_nama FROM tbl_barang WHERE barang_kode='$s->barang_kode'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->barang_kode; ?></td>
                                        <td><?= $nama->barang_nama; ?></td>
                                        <td><?= $s->keluar_jumlah; ?></td>
                                        <td><?= _rupiah($s->keluar_harga); ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->