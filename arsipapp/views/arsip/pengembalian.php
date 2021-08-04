<h1>Pengembalian Arsip</h1>

<div class="form-container">
    <div class="form-title"><i class="fas fa-folder fa-fw"></i> Peminjaman</div>
    <form action="<?= base_url("arsip/processkembali") ?>" id="disposisi-form" method="post" class="form-content">
        <div class="form-section">
            <input type="hidden" name="id_arsip" value="<?= $dataArsip->id_arsip ?>">
            <input type="hidden" name="id_pinjam" value="<?= $dataPinjam->id_pinjam ?>">

            <div class="form-label">Tanggal Kembali</div>
            <div class="form-input"><input value="<?= date("Y-m-d") ?>" type="date" name="tgl_kembali" id="tgl_kembali" class="input-data" required></div>

            <div class="form-label">Kondisi Kembali</div>
            <div class="form-input">
                <select name="kondisi_kembali" class="input-data" id="kondisi_kembali" required>
                    <option value="" selected disabled>Pilih kondisi kembali</option>
                    <option value="bagus">Bagus</option>
                    <option value="sedang">Sedang</option>
                    <option value="kurang">Kurang</option>
                </select>
            </div>

            <div class="form-label"></div>
            <div><b>Detail Peminjaman</b></div>

            <div class="form-label">Nama Peminjam</div>
            <div class="form-input"><input value="<?= $dataPinjam->nama_peminjam ?>" type="text" name="nama_peminjam" id="nama_peminjam" class="input-data" readonly required></div>

            <div class="form-label">Tanggal Pinjam</div>
            <div class="form-input"><input value="<?= $dataPinjam->tgl_pinjam ?>" type="date" name="tgl_pinjam" id="tgl_pinjam" class="input-data" readonly required></div>

            <div class="form-label">Batas Waktu</div>
            <div class="form-input"><input value="<?= $dataPinjam->batas_waktu ?>" type="date" name="batas_waktu" id="batas_waktu" class="input-data" readonly required></div>

            <div class="form-label">Petugas</div>
            <div class="form-input"><input value="<?= $petugas ?>" type="text" name="petugas" id="petugas" class="input-data" readonly></div>

            <div class="form-label">Kondisi Pinjam</div>
            <div class="form-input"><input value="<?= $dataPinjam->kondisi_pinjam ?>" type="text" name="kondisi_pinjam" id="kondisi_pinjam" class="input-data" readonly></div>
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