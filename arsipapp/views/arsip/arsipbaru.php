<h1>Arsip Baru</h1>

<div class="form-container">
    <div class="form-title"><i class="fas fa-folder-plus fa-fw"></i> Arsip</div>
    <form enctype="multipart/form-data" action="<?= base_url("arsip/processarsipbaru") ?>" method="post" class="form-content">
        <div class="form-section">
            <div class="form-label">Dari / Kepada</div>
            <div class="form-input"><input autofocus type="text" name="dari_kepada" id="dari_kepada" class="input-data" required></div>

            <div class="form-label">Alamat</div>
            <div class="form-input"><input type="text" name="alamat" id="alamat" class="input-data" required></div>

            <div class="form-label">Kota</div>
            <div class="form-input"><input type="text" name="kota" id="kota" class="input-data" required></div>

            <div class="form-label">No. Surat</div>
            <div class="form-input"><input type="text" name="no_surat" id="no_surat" class="input-data" required></div>

            <div class="form-label">Tanggal Surat</div>
            <div class="form-input"><input type="date" name="tgl_surat" id="tgl_surat" class="input-data" required></div>

            <div class="form-label">Indeks</div>
            <div class="form-input"><input type="text" name="indeks" id="indeks" class="input-data" required></div>

            <div class="form-label">No. Urut</div>
            <div class="form-input"><input type="number" min="1" name="no_urut" id="no_urut" class="input-data" required></div>

            <div class="form-label">Perihal</div>
            <div class="form-input"><input type="text" name="perihal" id="perihal" class="input-data" required></div>

            <div class="form-label">Tanggal Simpan</div>
            <div class="form-input"><input type="date" value="<?= date("Y-m-d") ?>" name="tgl_simpan" id="tgl_simpan" class="input-data" required></div>

            <div class="form-label">Jenis Surat</div>
            <div class="form-input">
                <select name="jenis_surat" id="jenis_surat" class="input-data" required>
                    <option value="" disabled selected>Pilih jenis surat</option>
                    <option value="M">Masuk</option>
                    <option value="K">Keluar</option>
                </select>
            </div>

            <div class="form-label">Kerahasiaan</div>
            <div class="form-input">
                <select name="kerahasiaan" id="kerahasiaan" class="input-data" required>
                    <option value="" disabled selected>Pilih jenis kerahasiaan</option>
                    <option value="B">Biasa</option>
                    <option value="R">Rahasia</option>
                    <option value="SR">Sangat Rahasia</option>
                </select>
            </div>

            <div class="form-label">Sistem Simpan</div>
            <div class="form-input">
                <select name="sistem_simpan" id="sistem_simpan" class="input-data" required>
                    <option value="" disabled selected>Pilih sistem simpan</option>
                    <option value="abjad">Abjad</option>
                    <option value="kronologi">Kronologi</option>
                    <option value="wilayah">Wilayah</option>
                </select>
            </div>

            <div class="form-label">Kode Simpan</div>
            <div class="form-input"><input type="text" name="kode_simpan" id="kode_simpan" class="input-data" required disabled></div>

            <div class="form-label">Isi Ringkasan</div>
            <!-- <div class="form-input"><input type="text" name="isi_ringkasan" id="isi_ringkasan" class="input-data" required></div> -->
            <div class="form-input"><textarea name="isi_ringkasan" id="isi_ringkasan" class="input-data"></textarea></div>

            <div class="form-label">Catatan</div>
            <div class="form-input"><textarea name="catatan" id="catatan" class="input-data"></textarea></div>

            <div class="form-label">Lampiran</div>
            <div class="form-input"><input type="file" name="lampiran[]" id="lampiran" class="input-data" multiple></div>
        </div>
        <div class="menu-section">
            <div class="context-menu"></div>
            <div class="button-wrapper">
                <button type="submit" class="btn green"><i class="fas fa-save fa-fw"></i> Simpan</button>
                <button class="btn red" id="reset-btn"><i class="fas fa-redo fa-fw"></i> Reset</button>
            </div>
        </div>
    </form>
</div>