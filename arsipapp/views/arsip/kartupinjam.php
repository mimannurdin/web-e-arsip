<?php

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Kartu Indeks');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('E-Arsip');
$pdf->SetDisplayMode('real', 'default');
$pdf->SetFont('helvetica', '', 12);

$pdf->AddPage();

$html = '
<table border="1" cellpadding="5">
    <tr>
        <th colspan="3" style="font-weight: bold; font-size: 1.3em" align="center">KARTU BUKTI PINJAM ARSIP / BERKAS</th>
    </tr>
    <tr>
        <td rowspan="3" style="color: #666">Peminjam</td>
        <td style="color: #666">Nama</td>
        <td>'.$dataPinjam->nama_peminjam.'</td>
    </tr>
    <tr>
        <td style="color: #666">Unit Kerja</td>
        <td></td>
    </tr>
    <tr>
        <td style="color: #666">Tanda Tangan</td>
        <td></td>
    </tr>
</table>
<table border="1" cellpadding="5">
    <tr>
        <th colspan="4" style="font-weight: bold; font-size: 1em" align="center">Arsip/Berkas yang Dipinjam</th>
    </tr>
    <tr>
        <td style="color: #666">Kode Simpan</td>
        <td colspan="3">'.$dataArsip->kode_simpan.'</td>
    </tr>

    <tr>
        <td style="color: #666">Tanggal Surat</td>
        <td>'.date("d-m-Y", strtotime($dataArsip->tgl_surat)).'</td>
        <td style="color: #666">No. Surat</td>
        <td>'.$dataArsip->no_surat.'</td>
    </tr>

    <tr>
        <td style="color: #666">Dari</td>
        <td colspan="3">'.$dataArsip->dari_kepada.'<br/>
        '.$dataArsip->alamat.'
        '.$dataArsip->kota.'
        </td>
    </tr>

    <tr>
        <td style="color: #666">Tanggal Pinjam</td>
        <td>'.date("d-m-Y", strtotime($dataPinjam->tgl_pinjam)).'</td>
        <td style="color: #666">Tanggal Kembali</td>
        <td>'.date("d-m-Y", strtotime($dataPinjam->batas_waktu)).'</td>
    </tr>
    <tr>
        <td colspan="2" style="color: #666">Paraf petugas arsip</td>
        <td colspan="2"></td>
    </tr>
</table>
';

// <table>
//     <tr>
//         <th colspan="3" style="font-weight: bold; font-size: 1.3em">KARTU BUKTI PINJAM ARSIP / BERKAS</th>
//     </tr>
//     <tr>
//         <td rowspan="Peminjam"></td>
//         <td>Nama</td>
//         <td>Nice name</td>
//     </tr>
//     <tr>
//         <td>Unit Kerja</td>
//         <td></td>
//     </tr>
//     <tr>
//         <td>Tanda Tangan</td>
//         <td></td>
//     </tr>
// </table>

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('kartu-pinjam-'.$dataArsip->id_arsip.'.pdf', 'I');