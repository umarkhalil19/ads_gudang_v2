<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Detail Barang Masuk</h3>
                        <div class="nk-block-des">
                            <p>Data Detail Barang Masuk</p>
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
                                    <p class="form-label">: <?= TanggalIndo($invoice->masuk_tgl) ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Nomor Invoice</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= $invoice->masuk_invoice ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Kurir</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= $invoice->masuk_kurir ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Distributor</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <p class="form-label">: <?= $invoice->masuk_distributor ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <p class="form-label" for="jumlah">Total Transaksi</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <b><p class="form-label" id="show_total"></p></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Detail Barang Masuk</h6>
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
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($masuk->result() as $m) {
                                    $brg = $this->db->query("SELECT barang_nama, barang_harga_satuan FROM tbl_barang WHERE barang_kode='$m->barang_kode'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $m->barang_kode; ?></td>
                                        <td><?= $brg->barang_nama; ?></td>
                                        <td><?= _rupiah($brg->barang_harga_satuan); ?></td>
                                        <td><?= $m->masuk_jumlah; ?></td>
                                        <td><?= _rupiah($m->masuk_jumlah * $brg->barang_harga_satuan); ?></td>
                                        <?php $total += ($m->masuk_jumlah * $brg->barang_harga_satuan);  ?>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td colspan="5">Total</td>
                                    <td id="_total"><b><?= _rupiah($total) ?></b></td>
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