<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/unimal.png">
    <!-- Page Title  -->
    <title>Login | Sukses Mandiri</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite.css?ver=2.0.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme.css?ver=2.0.0">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <!-- <div class="brand-logo pb-5">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg" src="<?= base_url() ?>assets/images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg" src="<?= base_url() ?>assets/new-unimal.jpeg" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                    </a>
                                </div> -->
                                <?php if (isset($_GET['notif'])) : _notif($this->session->flashdata($_GET['notif']));
                                endif; ?>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Login Sistem</h5>
                                        <div class="nk-block-des">
                                            <p>Akses Sistem Inventory Gudang Sukses Mandiri</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <?= form_open('login/cek'); ?>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="default-01">Username</label>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Masukkan Username Anda" name="username" value="<?= set_value('pass_lama') ?>">
                                    <?php echo form_error('username', '<small><span class="text-danger">', '</span></small>'); ?>
                                </div><!-- .foem-group -->
                                <div class=" form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg" id="password" placeholder="Masukkan Passsword Anda" name="password" value="<?= set_value('password') ?>">
                                    </div>
                                    <?php echo form_error('password', '<small style="margin-top:-20px"><span class="text-danger">', '</span></small>'); ?>
                                </div><!-- .foem-group -->
                                <div class=" form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>
                                    </div>
                                    <?= form_close() ?>
                                    <!-- <div class="form-note-s2 pt-4"> New on our platform? <a href="html/pages/auths/auth-register.html">Create an account</a>
                                </div> -->
                                </div><!-- .nk-block -->
                                <div class="nk-block nk-auth-footer">
                                    <div class="mt-3">
                                        <p>&copy; <?= date('Y') ?> ADS | Aceh Development System. All Rights Reserved.</p>
                                    </div>
                                </div><!-- .nk-block -->
                            </div><!-- .nk-split-content -->
                            <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                                    <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                                        <div class="slider-item">
                                            <div class="nk-feature nk-feature-center">
                                                <div class="nk-feature-img">
                                                    <img class="round" src="<?= base_url() ?>assets/images/slides/promo-a.png" srcset="./images/slides/promo-a2x.png 2x" alt="">
                                                </div>
                                                <div class="nk-feature-content py-4 p-sm-5">
                                                    <h4>Sistem Inventory Gudang</h4>
                                                    <p>Sistem Ini Dikembangkan oleh ADS | Aceh Development System</p>
                                                </div>
                                            </div>
                                        </div><!-- .slider-item -->
                                    </div><!-- .slider-init -->
                                    <div class="slider-dots"></div>
                                    <div class="slider-arrows"></div>
                                </div><!-- .slider-wrap -->
                            </div><!-- .nk-split-content -->
                        </div><!-- .nk-split -->
                    </div>
                    <!-- wrap @e -->
                </div>
                <!-- content @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
        <script src="<?= base_url() ?>assets/js/bundle.js?ver=2.0.0"></script>
        <script src="<?= base_url() ?>assets/js/scripts.js?ver=2.0.0"></script>

</html>