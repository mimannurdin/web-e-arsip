<h1>Buku Agenda Surat Masuk-Keluar</h1>

<table id="tabel-agenda" class="display">
    <thead>
        <th>Aksi</th>
        <th>Jenis Surat</th>
        <th>Dari/Kepada</th>
        <th>No. Surat</th>
        <th>Tgl. Surat</th>
        <th>Perihal</th>
        <th>Sistem Simpan</th>
        <th>Kode Simpan</th>
    </thead>

    <tbody>
        <?php
        foreach ($dataArsip as $key => $value) :
        ?>
            <tr>
                <td><a href="<?= base_url("arsip/manajemen/$value->id_arsip") ?>"><i class="fas fa-folder-open fa-fw"></i></a></td>
                <td><?= $value->jenis_surat ?></td>
                <td><?= $value->dari_kepada ?></td>
                <td><?= $value->no_surat ?></td>
                <td><?= $value->tgl_surat ?></td>
                <td><?= $value->perihal ?></td>
                <td><?= $value->sistem_simpan ?></td>
                <td><?= $value->kode_simpan ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>

<script>
$("#tabel-agenda").DataTable({
    "scrollX": true,
    "order": [[ 4, "asc" ]],
    "columnDefs": [
        {
            "targets": 0,
            "orderable": false
        }
    ]
});
</script>