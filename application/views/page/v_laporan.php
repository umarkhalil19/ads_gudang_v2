<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h3 class="title">Laporan</h3>
                        <div class="nk-block-des">
                            <p>Data Laporan</p>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                endif; ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle">Barang Masuk</h6>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount"> Laporan Barang Masuk
                                    </span>
                                </div>
                                <hr>
                                <div class="invest-data">
                                    <div class="invest-data-amount g-2">
                                        <div class="invest-data-history">
                                            <a href="<?= base_url() ?>laporan/barang_masuk" class="btn btn-primary btn-block">Tampilkan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle">Barang Keluar</h6>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount"> Laporan Barang Keluar
                                    </span>
                                </div>
                                <hr>
                                <div class="invest-data">
                                    <div class="invest-data-amount g-2">
                                        <div class="invest-data-history">
                                            <a href="<?= base_url() ?>laporan/barang_keluar" class="btn btn-primary btn-block">Tampilkan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- content @e -->