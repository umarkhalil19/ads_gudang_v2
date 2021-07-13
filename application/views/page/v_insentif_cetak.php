<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/logo_sukses_mandiri.png">
    <!-- Page Title  -->
    <title>Cetak Insentif</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite.css?ver=2.0.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme.css?ver=2.0.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body onload="window.print()">
    <!-- content @s -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <!-- <div class="nk-block-head-content">
                            <h3 class="title">Invoice</h3>
                            <div class="nk-block-des">
                            <p>Data Sales</p>
                        </div>
                        </div> -->
                    </div>
                    <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                    endif; ?>
                    <div class="card card-bordered card-full">
                        <div class="container mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-3" style="padding: 20px;">
                                    <img src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo" class="img-fluid">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <table class="datatable-init table-borderless">
                                        <tr>
                                            <td style="width: 150px;">Nama </td>
                                            <td>: <?= $sales->salless_nama ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px;">Alamat </td>
                                            <td>: <?= $sales->salless_alamat ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px;">No HP </td>
                                            <td>: <?= $sales->salles_no_hp ?></td>
                                        </tr>
                                        <?php
                                        $total_ = 0;
                                        foreach ($invoice->result() as $in) {
                                            $total_ += $in->invoice_total_harga;
                                        }
                                        ?>
                                        <tr>
                                            <td style="width: 150px;">Total Transaksi </td>
                                            <td><b><?= _rupiah($total_); ?></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <h5>Detail Invoice</h5>
                            <hr>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Invoice</th>
                                        <th>Toko</th>
                                        <th>Tanggal</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($invoice->result() as $i) {
                                        $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$i->invoice_toko'")->row();
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $i->invoice_kode; ?></td>
                                            <td><?= $toko->toko_nama; ?></td>
                                            <td><?= TanggalIndo($i->invoice_tgl); ?></td>
                                            <td><?= _rupiah($i->invoice_total_harga); ?></td>
                                            <?php $total += $i->invoice_total_harga; ?>
                                        </tr>
                                    <?php }
                                    ?>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td id="_total"><b><?= _rupiah($total); ?><b></td>
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
</body>
<!-- content @e -->
<script src="<?= base_url() ?>assets/js/bundle.js?ver=2.0.0"></script>
<script src="<?= base_url() ?>assets/js/scripts.js?ver=2.0.0"></script>
<script src="<?= base_url() ?>assets/js/charts/gd-invest.js?ver=2.0.0"></script>