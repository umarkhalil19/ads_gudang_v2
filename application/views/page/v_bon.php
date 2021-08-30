<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Bon / Faktur</h3>
                        <div class="nk-block-des">
                            <p>Data Bon / Faktur</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Bon / Faktur</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Detail Transaksi</th>
                                    <th>Total Harga</th>
                                    <th>Di Bayar</th>
                                    <th>Sisa</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($invoice->result() as $s) {
                                    //$a = $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id='$s->barang_satuan'")->row();
                                    $toko = $this->db->query("SELECT toko_nama,toko_alamat FROM tbl_toko WHERE toko_id='$s->invoice_toko'")->row();
                                    $a = $this->db->query("SELECT SUM(bon_dibayar) AS dibayar FROM tbl_bon_kredit WHERE kode_invoice='$s->invoice_kode'")->row();
                                    $b = $this->db->query("SELECT bon_total,bon_dibayar FROM tbl_bon_kredit WHERE kode_invoice='$s->invoice_kode' ORDER BY bon_urut DESC LIMIT 1")->row();
                                    $sales = $this->db->query("SELECT salless_nama FROM tbl_salless WHERE salless_id='$s->invoice_salless'")->row();
                                    $trans_tot = $this->db->query("SELECT SUM(keluar_harga) AS harga FROM tbl_barang_keluar WHERE keluar_invoice='$s->invoice_kode'")->row();
                                    ?>
                                    
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->invoice_kode; ?></td>
                                        <td>
                                            Toko : <?= $toko->toko_nama . '/' . $toko->toko_alamat; ?><br>
                                            Sales : <?= $sales->salless_nama ?><br>
                                            Tanggal : <?= TanggalIndo($s->invoice_tgl) ?>
                                        </td>
                                       <td><?= _rupiah($trans_tot->harga); ?></td>
                                        <td><?= _rupiah($a->dibayar) ?></td>
                                        <td>
                                            <?php
                                            if ($a->dibayar >= ($trans_tot->harga)) {
                                                echo '<font class="badge badge-success">LUNAS</font>';
                                            } else {
                                                echo @_rupiah($trans_tot->harga - $a->dibayar);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('Bon/bon_detail/' . $s->invoice_kode); ?>" class="badge badge-info">Detail</a>
                                            <a href="<?= base_url('Bon/bon_cetak/' . $s->invoice_kode); ?>" class="badge badge-warning" target="_blank"><em class="icon ni ni-printer-fill"></em> Cetak</a>
                                        </td>
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