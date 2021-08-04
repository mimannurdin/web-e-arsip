<h1>Pencarian</h1>

<div class="form-container">
    <div class="form-title"><i class="fas fa-search fa-fw"></i> Pencarian Arsip</div>
    <form action="<?= base_url("arsip/processcari") ?>" id="disposisi-form" method="post" class="form-content">
        <div class="form-section">
            <div class="form-label">Dari / Kepada</div>
            <div class="form-input"><input type="text" name="dari_kepada" id="dari_kepada" class="input-data"></div>

            <div class="form-label">Jenis Surat</div>
            <div class="form-input">
                <select name="jenis_surat" id="jenis_surat" class="input-data">
                    <option value="" disabled selected>Pilih jenis surat</option>
                    <option value="M">Masuk</option>
                    <option value="K">Keluar</option>
                </select>
            </div>
            
            <div class="form-label">No. Surat</div>
            <div class="form-input"><input type="text" name="no_surat" id="no_surat" class="input-data"></div>

            <div class="form-label">Alamat</div>
            <div class="form-input"><input type="text" name="alamat" id="alamat" class="input-data"></div>

            <div class="form-label">Kode Simpan</div>
            <div class="form-input"><input type="text" name="kode_simpan" id="kode_simpan" class="input-data"></div>

            <div class="form-label">Perihal</div>
            <div class="form-input"><input type="text" name="perihal" id="perihal" class="input-data"></div>

            <div class="form-label">Tanggal Surat</div>
            <div class="form-input"><input type="date" name="tgl_surat" id="tgl_surat" class="input-data"></div>
        </div>
        <div class="menu-section">
            <div class="context-menu"></div>
            <div class="button-wrapper">
                <button type="submit" class="btn green"><i class="fas fa-search fa-fw"></i> Cari</button>
                <button class="btn red" id="reset-btn"><i class="fas fa-redo fa-fw"></i> Reset</button>
            </div>
        </div>
    </form>
</div>