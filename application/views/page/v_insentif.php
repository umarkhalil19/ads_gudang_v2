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
                                        <!-- <td>
                                            <?= form_open('Insentif/tampil_insentif'); ?>
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
                                        </td> -->
                                        <td><button type="button" class="btn btn-sm btn-success dInsentif" data-id="<?= $s->salless_id ?>">Detail Insentif</button></td>
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

<div class="modal fade" id="salless_id" tabindex="-1" role="dialog" aria-labelledby="komenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insentif Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Insentif/insentif_detail') ?>
            <div class="modal-body">
                <input type="hidden" class="input_salless_id" name="input_salless_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Dari tanggal</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="dari_tgl">
                            </div>
                            <div class="form-note">Insentif akan ditampilkan dari tanggal ini</div>
                            <?php echo form_error('dari_tgl', '<small><span class="text-danger">', '</span></small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Hingga tanggal</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="hingga_tgl">
                            </div>
                            <div class="form-note">Insentif akan ditampilkan hingga tanggal ini</div>
                            <?php echo form_error('hingga_tgl', '<small><span class="text-danger">', '</span></small>'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Proses</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.dInsentif').click(function(e) {
            var salless_id = $(this).data('id');
            $(".input_salless_id").val(salless_id);
            $('#salless_id').modal('show');
        });
    });
</script>