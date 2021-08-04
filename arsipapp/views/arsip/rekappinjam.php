<?php

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('REKAP PEMINJAMAN ARSIP');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('E-Arsip');
$pdf->SetDisplayMode('real', 'default');
$pdf->SetFont('helvetica', '', 12);

$pdf->AddPage('L');

$html = '
<table>
<tr>
    <th align="center" style="font-weight: bold; font-size: 1.5em">REKAP PEMINJAMAN ARSIP</th>
</tr>
</table>
<table border="1" cellpadding="4">
    <tr>
        <th width="30">No</th>
        <th width="200">Nama Peminjam</th>
        <th width="183">Tanggal Pinjam</th>
        <th width="183">Batas Waktu</th>
        <th width="183">Tanggal Kembali</th>
    </tr>
    ';

$i = 1;
foreach ($dataPinjam as $key => $value) {
    $html .= '<tr>';
    $html .= '<td>'.$i.'</td>';
    $html .= '<td>'.$value->nama_peminjam.'</td>';
    $html .= '<td>'.$value->tgl_pinjam.'</td>';
    $html .= '<td>'.$value->batas_waktu.'</td>';
    $html .= '<td>'.$value->tgl_kembali.'</td>';
    $html .= '</tr>';
    $i++;
}

$html .= '
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('rekap-peminjaman-earsip.pdf', 'I');