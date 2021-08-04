<!-- <h1>Indexpage</h1> -->
<div class="main-menu">
    <div class="slider">
        <div class="button prev" id="prev">❮</div>
        <div class="button next" id="next">❯</div>

        <div class="slider-content" id="slider-content">
            <a href="<?= base_url("arsip/rekapmasuk") ?>" target="_blank">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-envelope fa-fw"></i> Rekap Surat Masuk</b>
                    </div>

                    <div class="details">
                        Berisi tabel rekapitulasi arsip surat masuk.
                    </div>
                </div>
            </a>

            <a href="<?= base_url("arsip/rekapkeluar") ?>" target="_blank">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-envelope-open-text fa-fw"></i> Rekap Surat Keluar</b>
                    </div>

                    <div class="details">
                        Berisi tabel rekapitulasi arsip surat keluar.
                    </div>
                </div>
            </a>

            <a href="<?= base_url("arsip/arsipbaru") ?>">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-folder-plus fa-fw"></i> Arsip Baru</b>
                    </div>

                    <div class="details">
                        Halaman yang digunakan untuk menambah arsip baru.
                    </div>
                </div>
            </a>

            <a href="<?= base_url("arsip/bukuagenda") ?>">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-folder-open fa-fw"></i> Buku Agenda</b>
                    </div>

                    <div class="details">
                        Halaman yang berisi daftar arsip surat masuk dan keluar dengan sajian tabel.
                    </div>
                </div>
            </a>

            <a href="<?= base_url("arsip/rekapbuku") ?>" target="_blank">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-mail-bulk fa-fw"></i> Rekap Buku Agenda</b>
                    </div>

                    <div class="details">
                        Berisi tabel rekapitulasi arsip surat masuk dan keluar.
                    </div>
                </div>
            </a>

            <a href="<?= base_url("arsip/rekappinjam") ?>" target="_blank">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-people-carry fa-fw"></i> Rekap Pinjam Arsip</b>
                    </div>

                    <div class="details">
                        Berisi tabel rekapitulasi arsip surat masuk dan keluar.
                    </div>
                </div>
            </a>

            <a href="<?= base_url("arsip/pencarian") ?>">
                <div class="content">
                    <div class="title">
                        <b><i class="fas fa-search fa-fw"></i> Pencarian Arsip</b>
                    </div>

                    <div class="details">
                        Pencarian arsip berdasarkan nomor surat, indeks, no_urut, alamat, kode simpan, dan perihal.
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>