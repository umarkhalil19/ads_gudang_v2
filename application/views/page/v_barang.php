<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Barang</h3>
                        <div class="nk-block-des">
                            <p>Data Barang</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Barang</h6>
                            </div>
                            <div class="card-tools">
                                <a href="<?= base_url("barang/barang_add/") ?>" class="btn btn-primary btn-sm"> Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama</th>
                                    <th>Satuan Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($barang->result() as $s) {
                                    $a = $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id='$s->barang_satuan'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->barang_kode; ?></td>
                                        <td><?= $s->barang_nama; ?></td>
                                        <td><?= $a->satuan_nama; ?></td>
                                        <td><?= _rupiah($s->barang_harga_satuan); ?></td>
                                        <td><?= $s->barang_jumlah; ?></td>
                                        <td>
                                            <a href="<?= base_url('barang/barang_edit/' . $s->barang_kode); ?>" class="badge badge-warning">Edit</a>
                                            <button id="<?= base_url('barang/barang_delete/' . $s->barang_kode); ?>" class="badge badge-danger btn-delete">Hapus</button>
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