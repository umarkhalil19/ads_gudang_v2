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
                                    <h6 class="title">Barang Masuk - Tanggal <?= _tglIndo(_tgl($dari_tgl)); ?> s/d <?= _tglIndo(_tgl($hingga_tgl)); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-3 mb-3">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Invoice</th>
                                        <th>Jumlah</th>
                                        <th>Kurir</th>
                                        <th>Distributor</th>
                                        <th>Tanggal</th>
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
</body>
<!-- content @e -->
<script src="<?= base_url() ?>assets/js/bundle.js?ver=2.0.0"></script>
<script src="<?= base_url() ?>assets/js/scripts.js?ver=2.0.0"></script>
<script src="<?= base_url() ?>assets/js/charts/gd-invest.js?ver=2.0.0"></script>