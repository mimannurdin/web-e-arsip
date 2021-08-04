<header class="header">
    <nav class="nav">
        <div class="nav-container">
            <?php
            if ($page != 'home' && $page != 'masuk' && $page != 'daftar') :
            ?>
                <div class="hamburger" id="hamburger"><i class="fas fa-bars fa-fw"></i></div>
            <?php
            endif;
            ?>
            <div class="logo-container" id="logo-container">
                <div class="logo"></div>
            </div>

            <!-- <div class="nav-link">
                <a href="">Test</a>
            </div> -->

            <?php
            if ($page != 'masuk' && $page != 'daftar') :
            ?>
                <div class="user-profile" id="user-profile">
                    <div class="user-avatar"></div>
                    <div class="username"><?= $userData->nama ?></div>
                </div>

                <div class="mini-menu" id="mini-menu">
                    <a href="<?= base_url("arsip/usersettings") ?>" class="mini-link"><i class="fas fa-cog fa-fw"></i> Pengaturan</a>
                    <a href="<?= base_url("arsip/logout") ?>" class="mini-link"><i class="fas fa-sign-out-alt fa-fw"></i> Keluar</a>
                </div>
            <?php
            endif;
            ?>
        </div>
    </nav>
</header>