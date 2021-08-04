<h1>Buat Kartu Disposisi</h1>


<div class="form-container">
    <div class="form-title"><i class="fas fa-folder fa-fw"></i> Disposisi</div>
    <form action="<?= base_url("arsip/cetakdisposisi") ?>" id="disposisi-form" method="post" class="form-content" target="_blank">
        <div class="form-section">
            <input type="hidden" name="id_arsip" value="<?= $dataArsip->id_arsip ?>">
            <div class="form-label">Indeks</div>
            <div class="form-input"><input value="<?= $dataArsip->indeks ?>" type="text" name="indeks" id="indeks" class="input-data" readonly required></div>

            <div class="form-label">Kode Simpan</div>
            <div class="form-input"><input value="<?= $dataArsip->kode_simpan ?>" type="text" name="kode_simpan" id="kode_simpan" class="input-data" required readonly></div>

            <div class="form-label">Tanggal Surat</div>
            <div class="form-input"><input value="<?= $dataArsip->tgl_surat ?>" type="date" name="tgl_surat" id="tgl_surat" class="input-data" readonly required></div>

            <div class="form-label">No. Surat</div>
            <div class="form-input"><input value="<?= $dataArsip->no_surat ?>" type="text" name="no_surat" id="no_surat" class="input-data" readonly required></div>

            <div class="form-label">Asal Surat</div>
            <div class="form-input"><input value="<?= $dataArsip->dari_kepada ?>" autofocus type="text" name="dari_kepada" id="dari_kepada" class="input-data" readonly required></div>

            <div class="form-label">Isi Ringkasan</div>
            <div class="form-input"><textarea name="isi_ringkasan" id="isi_ringkasan" class="input-data" readonly><?= $dataArsip->isi_ringkasan ?></textarea></div>

            <div class="form-label">Tanggal Diterima</div>
            <div class="form-input"><input type="date" value="<?= $dataArsip->tgl_simpan ?>" name="tgl_simpan" id="tgl_simpan" class="input-data" readonly required></div>

            <div class="form-label">Tanggal Penyelesaian</div>
            <div class="form-input"><input type="date" name="tgl_penyelesaian" id="tgl_penyelesaian" class="input-data" required></div>

            <div class="form-label">Isi Disposisi</div>
            <div class="form-input"><textarea name="isi_disposisi" id="isi_disposisi" class="input-data" required></textarea></div>

            <div class="form-label">Diteruskan kepada</div>
            <div class="form-input" id="kepada">
                <input type="text" name="kepada[]" id="kepada1" class="input-data" placeholder="Pihak 1">
                <input type="text" name="kepada[]" id="kepada2" class="input-data" placeholder="Pihak 2">
                <input type="text" name="kepada[]" id="kepada3" class="input-data" placeholder="Pihak 3">
            </div>

            <div class="form-label">Dikembalikan kepada</div>
            <div class="form-input"><input type="text" name="dikembalikan_ke" id="dikembalikan_ke" class="input-data" required></div>
        </div>
        <div class="menu-section">
            <div class="context-menu"></div>
            <div class="button-wrapper">
                <button type="submit" class="btn green" id="print-btn"><i class="fas fa-print fa-fw"></i> Cetak</button>
                <button class="btn red" id="reset-btn"><i class="fas fa-redo fa-fw"></i> Reset</button>
            </div>
        </div>
    </form>
</div>

<script>
$("#disposisi-form").submit((event) => {
    console.log("nice");
    window.location = '<?= base_url("arsip/manajemen/$dataArsip->id_arsip") ?>';
});
</script>
