<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Barang Masuk</h3>
                        <div class="nk-block-des">
                            <p>Data Barang Masuk</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>

                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Barang Masuk</h6>
                            </div>
                            <div class="card-tools">
                                <a href="<?= base_url("barang_masuk/barang_masuk_add/") ?>" class="btn btn-primary btn-sm"> Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Invoice</th>
                                    <th>Jumlah</th>
                                    <th>Kurir</th>
                                    <th>Distributor</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($barang_masuk->result() as $b) {
                                    $jumlah = $this->db->query("SELECT masuk_jumlah FROM tbl_barang_masuk WHERE masuk_invoice = '$b->masuk_invoice'")->result();
                                    $total = 0;
                                    foreach ($jumlah as $j) {
                                        $total += $j->masuk_jumlah;
                                    }
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $b->masuk_invoice; ?></td>
                                        <td><?= $total; ?></td>
                                        <td><?= $b->masuk_kurir; ?></td>
                                        <td><?= $b->masuk_distributor; ?></td>
                                        <td><?= _tglIndo($b->masuk_tgl); ?></td>
                                        <td> 
                                            <a href="<?= base_url('barang_masuk/barang_masuk_detail/' . $b->masuk_invoice); ?>" class="badge badge-success">Detail</a>
                                            <?php if ($b->masuk_tgl == date('Y-m-d')) { ?>
                                                <a href="<?= base_url('barang_masuk/barang_masuk_delete/' . $b->masuk_invoice); ?>" class="badge badge-danger">Hapus</a>
                                            <?php } ?>
                                        </td>
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