<!DOCTYPE html>
<html lang="zxx" class="js">
<?php
$toko = $this->m_vic->edit_data(['toko_id' => $invoice->invoice_toko], 'tbl_toko')->row();
$sales = $this->m_vic->edit_data(['salless_id' => $invoice->invoice_salless], 'tbl_salless')->row();
?>

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/unimal.png">
    <!-- Page Title  -->
    <title>Cetak Invoice</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite.css?ver=2.0.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme.css?ver=2.0.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="nk-body npc-invest bg-lighter">
    <!-- content @s -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h3 class="title">Invoice</h3>
                            <!-- <div class="nk-block-des">
                            <p>Data Sales</p>
                        </div> -->
                        </div>
                    </div>
                    <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                    endif; ?>
                    <div class="card card-bordered card-full">
                        <div class="container mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-3" style="padding: 20px;">
                                    <img src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo" class="img-fluid">
                                    <p>
                                        Alamat : <br>
                                        Telp : <br>
                                    </p>
                                </div>
                                <div class="col-md-4 offset-md-5" style="padding: 20px;">
                                    <h4>INVOICE # : <?= $invoice->invoice_kode ?></h4>
                                    <p>
                                        <strong> Toko <?= $toko->toko_nama ?></strong><br>
                                        <?= $toko->toko_alamat ?> <br>
                                        Telp : <?= $toko->toko_no_hp ?> <br>
                                        Sales : <?= $sales->salless_nama ?> / <?= $sales->salles_no_hp ?> <br>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($barang->result() as $b) {
                                        $nama = $this->db->query("SELECT barang_nama FROM tbl_barang WHERE barang_kode='$b->barang_kode'")->row();
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $b->barang_kode; ?></td>
                                            <td><?= $nama->barang_nama; ?></td>
                                            <td><?= $b->keluar_jumlah; ?></td>
                                            <td><?= _rupiah($b->keluar_harga); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td><b><?= _rupiah($invoice->invoice_total_harga) ?></b></td>
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

</html>