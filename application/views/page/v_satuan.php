<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Satuan</h3>
                        <div class="nk-block-des">
                            <p>Data Satuan</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Satuan</h6>
                            </div>
                            <div class="card-tools">
                                <a href="<?= base_url("satuan/satuan_add/") ?>" class="btn btn-primary btn-sm"> Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($satuan->result() as $s) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->satuan_nama; ?></td>
                                        <td>
                                            <a href="<?= base_url('satuan/satuan_edit/' . $s->satuan_id); ?>" class="badge badge-warning">Edit</a>
                                            <button id="<?= base_url('satuan/satuan_delete/' . $s->satuan_id); ?>" class="badge badge-danger btn-delete">Hapus</button>
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