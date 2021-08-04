<h1>Pinjam Arsip</h1>

<div class="form-container">
    <div class="form-title"><i class="fas fa-folder fa-fw"></i> Peminjaman</div>
    <form action="<?= base_url("arsip/processpinjam") ?>" id="disposisi-form" method="post" class="form-content">
        <div class="form-section">
            <input type="hidden" name="id_arsip" value="<?= $dataArsip->id_arsip ?>">
            <div class="form-label">Nama Peminjam</div>
            <div class="form-input"><input type="text" name="nama_peminjam" id="nama_peminjam" class="input-data" required></div>

            <div class="form-label">Tanggal Pinjam</div>
            <div class="form-input"><input value="<?= date("Y-m-d") ?>" type="date" name="tgl_pinjam" id="tgl_pinjam" class="input-data" required></div>

            <div class="form-label">Batas Waktu</div>
            <div class="form-input"><input type="date" name="batas_waktu" id="batas_waktu" class="input-data" required></div>

            <div class="form-label">Kondisi Pinjam</div>
            <div class="form-input">
                <select name="kondisi_pinjam" class="input-data" id="kondisi_pinjam" required>
                    <option value="" selected disabled>Pilih kondisi pinjam</option>
                    <option value="bagus">Bagus</option>
                    <option value="sedang">Sedang</option>
                    <option value="kurang">Kurang</option>
                </select>
            </div>
        </div>
        <div class="menu-section">
            <div class="context-menu"></div>
            <div class="button-wrapper">
                <button type="submit" class="btn green"><i class="fas fa-file-upload fa-fw"></i> Pinjam</button>
                <button class="btn red" id="reset-btn"><i class="fas fa-redo fa-fw"></i> Reset</button>
            </div>
        </div>
    </form>
</div>