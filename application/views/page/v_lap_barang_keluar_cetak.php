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
                    <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                    endif; ?>

                    <div class="row">
                        <div class="col-md-3" style="padding: 20px;">
                            <img src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo" class="img-fluid">
                        </div>
                    </div>

                    <div class="card card-bordered card-full">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group container">
                                <div class="card-title">
                                    <h6 class="title">Barang Keluar - Tanggal <?= _tglIndo(_tgl($dari_tgl)); ?> s/d <?= _tglIndo(_tgl($hingga_tgl)); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-3 mb-3">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Invoice</th>
                                        <th>Sales</th>
                                        <th>Toko</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($barang_keluar->result() as $s) {
                                        $toko = $this->db->query("SELECT toko_nama FROM tbl_toko WHERE toko_id='$s->invoice_toko'")->row();
                                        $sales = $this->db->query("SELECT salless_nama FROM tbl_salless WHERE salless_id='$s->invoice_salless'")->row();
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $s->invoice_kode; ?></td>
                                            <td><?= $sales->salless_nama; ?></td>
                                            <td><?= $toko->toko_nama; ?></td>
                                            <?php $total += $s->invoice_total_harga; ?>
                                            <td><?= _rupiah($s->invoice_total_harga); ?></td>
                                            <td><?= _tglIndo($s->invoice_tgl) ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><b>Total</b></td>
                                        <td><b>: <?= _rupiah($total) ?></b></td>
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