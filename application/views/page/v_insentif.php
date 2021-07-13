<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Insentif</h3>
                        <div class="nk-block-des">
                            <p>Data Insentif Sales</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group container">
                            <div class="card-title">
                                <h6 class="title">Tabel Data Sales</h6>
                            </div>
                            <div class="card-tools">
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">

                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Sales</th>
                                    <th>Alamat</th>
                                    <th>No. Hp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sales->result() as $s) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->salless_nama; ?></td>
                                        <td><?= $s->salless_alamat; ?></td>
                                        <td><?= $s->salles_no_hp; ?></td>
                                        <td>
                                        <?= form_open('insentif/tampil_insentif'); ?>
                                        <input type="hidden" name="sales_id" value="<?= $s->salless_id ?>">
                                            <div class="row">
                                                <div class="form-group col-md-6" style="width: 150px;">
                                                    <div class="form-control-wrap">
                                                        <input type="month" class="form-control" name="bulan" id="bulan" type="date" autocomplete="off" autofocus value="<?= set_value('bulan') ?>">
                                                        <?php echo form_error('bulan', '<small><span class="text-danger">', '</span></small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-sm btn-success">Tampilkan</button>
                                                </div>
                                            </div>
                                            <?= form_close(); ?>
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