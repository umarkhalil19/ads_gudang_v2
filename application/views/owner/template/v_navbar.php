<body class="nk-body npc-invest bg-lighter">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap">
            <!-- main header @s -->
            <div class="nk-header nk-header-fluid is-theme">
                <div class="container-xl wide-xl">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="<?= base_url() ?>" class="logo-link">
                                <img class="logo-light logo-img" src="<?= base_url() ?>assets/logo_sukses_mandiri.png" srcset="<?= base_url() ?>assets/logo_sukses_mandiri.png" alt="logo">
                                <img class="logo-dark logo-img" src="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" srcset="<?= base_url() ?>assets/logo_sukses_mandiri_dark.png" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="<?= base_url() ?>" class="logo-link">
                                        <img class="logo-light logo-img" src="<?= base_url() ?>assets/logo_darkbkd.png" srcset="./images/logo2x.png 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="<?= base_url() ?>assets/logo_darkbkd.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger mr-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <li class="nk-menu-item has-sub">
                                    <a href="<?= base_url(); ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Dashboards</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="<?= base_url('admin/users') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Users</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Master Data</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="<?= base_url('Sales') ?>" class="nk-menu-link"><span class="nk-menu-text">Salesman</span></a>
                                        </li>
                                    </ul>
                                </li> -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Master Data</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="<?= base_url('Sales') ?>" class="nk-menu-link"><span class="nk-menu-text">Salesman</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?= base_url('Toko') ?>" class="nk-menu-link"><span class="nk-menu-text">Toko</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?= base_url('Satuan') ?>" class="nk-menu-link"><span class="nk-menu-text">Satuan Barang</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="<?= base_url('Distributor') ?>" class="nk-menu-link"><span class="nk-menu-text">Distributor</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="<?= base_url('Insentif') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Insentif</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="<?= base_url('Bon') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Bon / Faktur</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="<?= base_url('laporan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-text">Laporan</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown notification-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                    </a>
                                </li><!-- .dropdown -->
                                <li class="dropdown user-dropdown order-sm-first">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-xl-block">
                                                <div class="user-status">Owner</div>
                                                <div class="user-name dropdown-indicator"><?= $this->session->userdata('name'); ?></div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?= $this->session->userdata('name'); ?></span>
                                                    <!-- <span class="sub-text">helminaluri@unimal.ac.id</span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="<?= base_url(); ?>owner/change_pass"><em class="icon ni ni-lock-alt"></em><span>Ubah Password</span></a></li>
                                                <!-- <li><a href="html/invest/profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a href="html/invest/profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                <li><a class="dark-mode-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li> -->
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="<?= base_url() ?>owner/logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div>
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->