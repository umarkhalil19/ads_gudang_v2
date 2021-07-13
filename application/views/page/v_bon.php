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
                                    <th>Toko</th>
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
                                    $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$s->invoice_toko'")->row();
                                    $a = $this->db->query("SELECT SUM(bon_dibayar) AS dibayar FROM tbl_bon_kredit WHERE kode_invoice='$s->invoice_kode'")->row();
                                    $b = $this->db->query("SELECT bon_total,bon_dibayar FROM tbl_bon_kredit WHERE kode_invoice='$s->invoice_kode' ORDER BY bon_urut DESC LIMIT 1")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->invoice_kode; ?></td>
                                        <td><?= $toko->toko_nama; ?></td>
                                        <td><?= _rupiah($s->invoice_total_harga); ?></td>
                                        <td><?= _rupiah($a->dibayar) ?></td>
                                        <td>
                                            <?php
                                            if ($b->bon_total == $b->bon_dibayar) {
                                                echo '<font class="badge badge-success">LUNAS</font>';
                                            } else {
                                                echo @_rupiah($b->bon_total);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('bon/bon_detail/' . $s->invoice_kode); ?>" class="badge badge-info">Detail</a>
                                            <a href="<?= base_url('bon/bon_cetak/' . $s->invoice_kode); ?>" class="badge badge-warning" target="_blank"><em class="icon ni ni-printer-fill"></em> Cetak</a>
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