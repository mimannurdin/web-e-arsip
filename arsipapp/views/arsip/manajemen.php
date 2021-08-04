<?php
$sistemSimpan = array(
    'abjad'     => 'Abjad',
    'kronologi' => 'Kronologi',
    'wilayah'   => 'Wilayah',
);

$kerahasiaan = array(
    'B'  => 'Biasa',
    'R'  => 'Rahasia',
    'SR' => 'Sangat Rahasia',
);

$jenisSurat = array(
    'M' => 'Masuk',
    'K' => 'Keluar'
);
?>

<h1>Manajemen</h1>

<div class="form-container">
    <div class="form-title"><i class="fas fa-folder fa-fw"></i> Manajemen Arsip <?php
    if ($dipinjam) :
    ?>
        <span class="dipinjam"><i class="fas fa-exclamation-triangle fa-fw"></i> Arsip sedang dipinjam</span>
    <?php
    endif;
    ?></div>
    <form enctype="multipart/form-data" action="<?= base_url("arsip/processmanajemen") ?>" method="post" class="form-content">
        <div class="form-section">
            <div class="form-label">Dari / Kepada</div>
            <input type="hidden" name="id_arsip" value="<?= $dataArsip->id_arsip ?>">
            <div class="form-input"><input autofocus value="<?= $dataArsip->dari_kepada ?>" type="text" name="dari_kepada" id="dari_kepada" class="input-data" required></div>

            <div class="form-label">Alamat</div>
            <div class="form-input"><input value="<?= $dataArsip->alamat ?>" type="text" name="alamat" id="alamat" class="input-data" required></div>

            <div class="form-label">Kota</div>
            <div class="form-input"><input value="<?= $dataArsip->kota ?>" type="text" name="kota" id="kota" class="input-data" required></div>

            <div class="form-label">No. Surat</div>
            <div class="form-input"><input value="<?= $dataArsip->no_surat ?>" type="text" name="no_surat" id="no_surat" class="input-data" required></div>

            <div class="form-label">Tanggal Surat</div>
            <div class="form-input"><input value="<?= $dataArsip->tgl_surat ?>" type="date" name="tgl_surat" id="tgl_surat" class="input-data" required></div>

            <div class="form-label">Indeks</div>
            <div class="form-input"><input value="<?= $dataArsip->indeks ?>" type="text" name="indeks" id="indeks" class="input-data" required></div>

            <div class="form-label">No. Urut</div>
            <div class="form-input"><input value="<?= $dataArsip->no_urut ?>" type="number" min="1" name="no_urut" id="no_urut" class="input-data" required></div>

            <div class="form-label">Perihal</div>
            <div class="form-input"><input value="<?= $dataArsip->perihal ?>" type="text" name="perihal" id="perihal" class="input-data" required></div>

            <div class="form-label">Tanggal Simpan</div>
            <div class="form-input"><input value="<?= $dataArsip->tgl_simpan ?>" type="date" name="tgl_simpan" id="tgl_simpan" class="input-data" required></div>

            <div class="form-label">Jenis Surat</div>
            <div class="form-input">
                <select name="jenis_surat" id="jenis_surat" class="input-data" required>
                    <option value="" disabled>Pilih jenis surat</option>
                    <!-- <option value="M">Masuk</option>
                    <option value="K">Keluar</option> -->

                    <?php
                    foreach ($jenisSurat as $key => $value) :
                    ?>
                        <option value="<?= $key ?>" <?php
                        if ($dataArsip->jenis_surat == $key) {
                            echo 'selected';
                        }
                        ?>><?= $value ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-label">Kerahasiaan</div>
            <div class="form-input">
                <select name="kerahasiaan" id="kerahasiaan" class="input-data" required>
                    <option value="" disabled>Pilih jenis kerahasiaan</option>
                    <?php
                    foreach ($kerahasiaan as $key => $value) :
                    ?>
                        <option value="<?= $key ?>" <?php
                        if ($dataArsip->kerahasiaan == $key) {
                            echo 'selected';
                        }
                        ?>><?= $value ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-label">Sistem Simpan</div>
            <div class="form-input">
                <select name="sistem_simpan" id="sistem_simpan" class="input-data" required>
                    <option value="" disabled>Pilih sistem simpan</option>
                    <?php
                    foreach ($sistemSimpan as $key => $value) :
                    ?>
                        <option value="<?= $key ?>" <?php
                        if ($dataArsip->sistem_simpan == $key) {
                            echo 'selected';
                        }
                        ?>><?= $value ?></option>
                    <?php
                    endforeach;
                    ?>
                    
                </select>
            </div>

            <div class="form-label">Kode Simpan</div>
            <div class="form-input"><input value="<?= $dataArsip->kode_simpan ?>" type="text" name="kode_simpan" id="kode_simpan" class="input-data" required></div>

            <div class="form-label">Isi Ringkasan</div>
            <div class="form-input"><textarea name="isi_ringkasan" id="isi_ringkasan" class="input-data"><?= $dataArsip->isi_ringkasan ?></textarea></div>

            <div class="form-label">Catatan</div>
            <div class="form-input"><textarea name="catatan" id="catatan" cols="30" rows="10" class="input-data"><?= $dataArsip->catatan ?></textarea></div>

            <div class="form-label"></div>
            <div class="file-lampiran">
                <!-- <div class="form-group">
                    <input type="checkbox" class="checkbox-trash" name="file[1]" id="file1">
                    <label for="file1"><i class="fas fa-trash-alt fa-fw"></i></label>
                </div>
                <a href="#">Nice.pdf</a> -->
                <?php
                foreach ($dataLampiran as $key => $value) :
                ?>
                    <div class="form-group">
                        <input type="checkbox" class="checkbox-trash" value="true" name="remove_file[<?= $value->id_lampiran ?>]" id="remove_file<?= $value->id_lampiran ?>">
                        <label for="remove_file<?= $value->id_lampiran ?>"><i class="fas fa-trash-alt fa-fw"></i></label>
                    </div>
                    <a href="#"><?= $value->nama_file ?></a>
                <?php
                endforeach;
                ?>
            </div>

            <div class="form-label">Tambah Lampiran</div>
            <div class="form-input"><input type="file" name="lampiran[]" id="lampiran" class="input-data" multiple></div>
        </div>
        <div class="menu-section">
            <div class="context-menu">
                <div class="menu-item">
                    <a href="<?= base_url("arsip/buatdisposisi/$dataArsip->id_arsip") ?>">
                        <span class="fa-stack icon">
                            <i class="far fa-file fa-stack-2x"></i>
                            <i class="fas fa-arrow-right fa-stack-1x" data-fa-transform="right-14"></i>
                        </span> Disposisi
                    </a>
                </div>

                <div class="menu-item">
                    <a href="<?= base_url("arsip/buatIndeks/$dataArsip->id_arsip") ?>" target="_blank">
                        <i class="far fa-file-alt fa-fw fa-2x icon"></i> Kartu indeks
                    </a>
                </div>
                
                <?php
                if (!$dipinjam) :
                ?>
                <div class="menu-item">
                    <a href="<?= base_url("arsip/pinjamarsip/$dataArsip->id_arsip") ?>">
                        <span class="fa-stack icon">
                            <i class="fas fa-people-carry fa-stack-2x"></i>
                            <i class="fas fa-arrow-up fa-stack-1x" data-fa-transform="up-14"></i>
                        </span> Peminjaman Arsip
                    </a>
                </div>

                <?php
                else:
                ?>
                <div class="menu-item">
                    <a href="<?= base_url("arsip/pengembalian/$dataArsip->id_arsip") ?>">
                        <span class="fa-stack icon">
                            <i class="fas fa-people-carry fa-stack-2x"></i>
                            <i class="fas fa-arrow-down fa-stack-1x" data-fa-transform="down-14"></i>
                        </span> Pengembalian Arsip
                    </a>
                </div>

                <div class="menu-item">
                    <a href="<?= base_url("arsip/cetakPinjam/$dataArsip->id_arsip") ?>" target="_blank">
                        <i class="fas fa-print fa-fw fa-2x icon"></i> Cetak kartu pinjam
                    </a>
                </div>
                <?php
                endif;
                ?>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="btn green"><i class="fas fa-save fa-fw"></i> Simpan</button>
                <button class="btn red" id="delete-btn"><i class="fas fa-trash-alt fa-fw"></i> Hapus</button>
            </div>
        </div>
    </form>
</div>
