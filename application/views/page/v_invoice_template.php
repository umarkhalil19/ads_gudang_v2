<!DOCTYPE html>
<html lang="zxx" class="js">
<?php
$toko = $this->m_vic->edit_data(['toko_id' => $invoice->invoice_toko], 'tbl_toko')->row();
$sales = $this->m_vic->edit_data(['salless_id' => $invoice->invoice_salless], 'tbl_salless')->row();

// =================================
$total_brg = $barang->num_rows();

$total_keluar = 0;
$total_diskon = 0;
$jumlah_brg = 0;
foreach ($barang->result() as $b) {
    $nama = $this->db->query("SELECT barang_harga_satuan FROM tbl_barang WHERE barang_kode='$b->barang_kode'")->row();
    $jumlah_brg = $jumlah_brg + $b->keluar_jumlah;
    $total_keluar = $total_keluar + ($b->keluar_jumlah * $nama->barang_harga_satuan);
    $total_diskon = $total_diskon + $b->keluar_diskon;
}
?>

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <!-- <link rel="shortcut icon" href="<?= base_url() ?>assets/img/unimal.png"> -->
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
                <div class="nk-content-body" style="margin-top: -30px;">
                    <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                    endif; ?>
                    <!-- <div class="card"> -->
                    <!-- <div class="container"> -->
                    <?php
                    $diskon = 0;
                    $total_page = ceil($total_brg / 10);
                    $page_from = 0;
                    $page_to = 10;
                    $no = 1;
                    for ($th = 1; $th <= $total_page; $th++) {
                    ?>
                        <div class="row">
                            <div class="col-md-6" style="padding: 20px;">
                                <img src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo" class="img-fluid" width="25%"><br>
                                <table>
                                    <tr>
                                        <td style="width: 100px;">Alamat</td>
                                        <td>:</td>
                                        <td>Jln. Medan-Banda Aceh Meunasah Mesjid Cunda-Kota Lhokseumawe</td>
                                    </tr>
                                    <tr>
                                        <td>Telp</td>
                                        <td>:</td>
                                        <td>08126406765</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 offset-md-2" style="padding: 20px;">
                                <table>
                                    <tr>
                                        <td style="width: 100px;font-size:16px;font-weight:bold;">INVOICE #</td>
                                        <td style="font-size: 16px;font-weight:bold;">:</td>
                                        <td style="font-size: 16px;font-weight:bold;"><?= $invoice->invoice_kode ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Toko</td>
                                        <td>:</td>
                                        <td><?= $toko->toko_nama ?> / <?= $toko->toko_alamat ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Sales</td>
                                        <td>:</td>
                                        <td><?= $sales->salless_nama ?> / <?= $sales->salles_no_hp ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;">Tanggal</td>
                                        <td>:</td>
                                        <td><?= TanggalIndo($invoice->invoice_tgl) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="row">
                        <div class="col-md-3" style="padding: 20px;">
                            <img src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo" class="img-fluid" width="50%"><br>
                            <font style="font-size: small;">
                                Alamat : Jln. Medan-Banda Aceh Meunasah Mesjid Cunda-Kota Lhokseumawe<br>
                                Telp : 0654-42595<br>
                            </font>
                        </div>
                        <div class="col-md-4 offset-md-5" style="padding: 20px;">
                            <h6>INVOICE # : <?= $invoice->invoice_kode ?></h6>
                            <font style="font-size: small;">
                                Toko <?= $toko->toko_nama ?><br>
                                <?= $toko->toko_alamat ?>/ Telp : <?= $toko->toko_no_hp ?> <br>
                                Sales : <?= $sales->salless_nama ?> / <?= $sales->salles_no_hp ?> <br>
                                Tanggal : <?= TanggalIndo($invoice->invoice_tgl) ?>
                            </font>
                        </div>
                    </div> -->
                        <?php
                        // $diskon = 0;
                        // $total_page = ceil($total_brg / 10);
                        // $page_from = 0;
                        // $page_to = 10;
                        // $no = 1;
                        // for ($th = 1; $th <= $total_page; $th++) {
                        ?>
                        <table class="table table-orders">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Harga@</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $barang = $this->m_vic->edit_data(['keluar_invoice' => $id], 'tbl_barang_keluar');
                                $barang = $this->db->query("SELECT * FROM tbl_barang_keluar WHERE keluar_invoice = '$id' LIMIT $page_from, $page_to");
                                foreach ($barang->result() as $b) {
                                    $nama = $this->db->query("SELECT barang_nama,barang_satuan,barang_harga_satuan FROM tbl_barang WHERE barang_kode='$b->barang_kode'")->row();
                                    $satuan = $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id='$nama->barang_satuan'")->row();
                                ?>
                                    <tr>
                                        <td style="font-size:medium;"><?= $no++ ?></td>
                                        <td style="font-size:medium;"><?= $b->barang_kode; ?></td>
                                        <td style="font-size:medium;"><?= $nama->barang_nama; ?></td>
                                        <td style="font-size:medium;"><?= $b->keluar_jumlah; ?></td>
                                        <td style="font-size:medium;"><?= $satuan->satuan_nama; ?></td>
                                        <td style="font-size:medium;"><?= _rupiah($nama->barang_harga_satuan); ?></td>
                                        <td style="font-size:medium;"><?= _rupiah($b->keluar_diskon); ?></td>
                                        <td style="font-size:medium;"><?= _rupiah($nama->barang_harga_satuan * $b->keluar_jumlah); ?></td>
                                        <?php
                                        $diskon = $diskon +  $b->keluar_diskon;
                                        ?>
                                    </tr>
                                <?php } ?>
                                <?php if ($th == $total_page && $barang->num_rows() <= 6) { ?>
                                    <tr>
                                        <td colspan="3" style="text-align: right; font-size:medium;">Jumlah : </td>
                                        <td style="font-size:medium;"><b><?= $jumlah_brg; ?></b></td>
                                        <td colspan="3" style="text-align: right; font-size:medium;">Total : </td>
                                        <td style="font-size:medium;"><b><?= _rupiah($total_keluar) ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right; font-size:medium;">Diskon : </td>
                                        <td style="font-size:medium;"><b><?= _rupiah($diskon) ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right; font-size:medium;">NETT : </td>
                                        <td style="font-size:medium;"><b><?= _rupiah($invoice->invoice_total_harga) ?></b></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php if ($th == $total_page && $barang->num_rows() > 6) { ?>
                            <div style="margin-bottom:200px"></div>
                            <div class="row">
                                <div class="col-md-6" style="padding: 20px;">
                                    <img src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo" class="img-fluid" width="25%"><br>
                                    <table>
                                        <tr>
                                            <td style="width: 100px;">Alamat</td>
                                            <td>:</td>
                                            <td>Jln. Medan-Banda Aceh Meunasah Mesjid Cunda-Kota Lhokseumawe</td>
                                        </tr>
                                        <tr>
                                            <td>Telp</td>
                                            <td>:</td>
                                            <td>08126406765</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4 offset-md-2" style="padding: 20px;">
                                    <table>
                                        <tr>
                                            <td style="width: 100px;font-size:16px;font-weight:bold;">INVOICE #</td>
                                            <td style="font-size: 16px;font-weight:bold;">:</td>
                                            <td style="font-size: 16px;font-weight:bold;"><?= $invoice->invoice_kode ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">Toko</td>
                                            <td>:</td>
                                            <td><?= $toko->toko_nama ?> / <?= $toko->toko_alamat ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">Sales</td>
                                            <td>:</td>
                                            <td><?= $sales->salless_nama ?> / <?= $sales->salles_no_hp ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px;">Tanggal</td>
                                            <td>:</td>
                                            <td><?= TanggalIndo($invoice->invoice_tgl) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <table class="table table-orders">
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="text-align: right; font-size:medium;" width="52%"> Jumlah : </td>
                                        <td style="font-size:medium;"><b><?= $jumlah_brg; ?></b></td>
                                        <td colspan="3" style="text-align: right; font-size:medium;" width="26%">Total : </td>
                                        <td style="font-size:medium;"><b><?= _rupiah($total_keluar) ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right; font-size:medium;">Diskon : </td>
                                        <td style="font-size:medium;"><b><?= _rupiah($diskon) ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right; font-size:medium;">NETT : </td>
                                        <td style="font-size:medium;"><b><?= _rupiah($invoice->invoice_total_harga) ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-3" style="padding: 10px;">
                                <hr>
                                <?= $toko->toko_nama ?>
                            </div>
                        <?php } else { ?>
                            <div style="margin-bottom:200px"></div>
                        <?php } ?>
                        <?php
                        $page_from = $page_from + 10;
                        //$page_to = $page_from + 10-1;
                        //echo $page_from;
                        //echo $page_to;
                        //die
                        ?>
                    <?php } ?>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
</body>

</html>