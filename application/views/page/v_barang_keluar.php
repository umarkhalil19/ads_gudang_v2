<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Barang Keluar</h3>
                        <div class="nk-block-des">
                            <p>Data Barang Keluar</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Barang Keluar</h6>
                            </div>
                            <div class="card-tools">
                                <a href="<?= base_url("Barang_Keluar/barang_keluar_add/") ?>" class="btn btn-primary btn-sm"> Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Sales</th>
                                    <th>Toko</th>
                                    <th>Total Harga</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($barang_keluar->result() as $s) {
                                    //$a = $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id='$s->barang_satuan'")->row();
                                    $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$s->invoice_toko'")->row();
                                    $sales = $this->db->query("SELECT salless_nama FROM tbl_salless WHERE salless_id='$s->invoice_salless'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->invoice_kode; ?></td>
                                        <td><?= $sales->salless_nama; ?></td>
                                        <td><?= $toko->toko_nama; ?></td>
                                        <td><?= _rupiah($s->invoice_total_harga); ?></td>
                                        <td>
                                            <a href="<?= base_url('Barang_Keluar/barang_keluar_detail/' . $s->invoice_kode); ?>" class="badge badge-info">Detail</a>
                                            <?php
                                            //if ($s->invoice_tgl == date('Y-m-d')) {
                                            ?>
                                            <button id="<?= base_url('Barang_Keluar/barang_keluar_delete/' . $s->invoice_kode); ?>" class="badge badge-danger btn-delete">Hapus</button>
                                            <?php //} 
                                            ?>
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