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
                <br>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>
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
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Diskon</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($keluar->result() as $s) {
                                    $brg = $this->db->query("SELECT barang_nama,barang_harga_satuan FROM tbl_barang WHERE barang_kode='$s->barang_kode'")->row();
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s->barang_kode; ?></td>
                                        <td><?= $brg->barang_nama; ?></td>
                                        <td><?= _rupiah($brg->barang_harga_satuan); ?></td>
                                        <td><?= $s->keluar_jumlah; ?></td>
                                        <td><?= _rupiah($s->keluar_diskon); ?></td>
                                        <td><?= _rupiah($s->keluar_harga); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger retur" data-id="<?= $s->keluar_id ?>">Retur Barang</button>
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

<div class="modal fade" id="retur" tabindex="-1" role="dialog" aria-labelledby="komenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title" id="komenModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Barang_Keluar/retur_barang') ?>
            <div class="modal-body">
                <label for="" class="form-label">Jumlah Barang Diretur</label>
                <input type="hidden" class="id_keluar" name="id_keluar" value="">
                <input type="number" class="form-control jumlah_barang" name="jumlah_barang" value="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Proses</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable-init').click(function(e) {
            var className = e.target.className
            if (className == 'btn btn-sm btn-danger retur') {
                var keluar_id = $(e.target).data('id');
                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url(); ?>Barang_Keluar/get_barang',
                    data: {
                        keluar_id: keluar_id,
                    },
                    success: function(data) {
                        $("#komenModalTitle").text('Form Retur Barang');
                        $(".jumlah_barang").val(data);
                        $(".id_keluar").val(keluar_id);
                        $('#retur').modal('show');
                    }
                });
            }
        });

    });
</script>