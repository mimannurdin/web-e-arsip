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
<table cellpadding="10">
    <tr>
        <th colspan="3" align="center" style="font-weight: bold; font-size: 1.5em">KARTU INDEKS</th>
    </tr>
    <tr>
        <th colspan="3" align="right">Indeks : '.$dataArsip->indeks.'</th>
    </tr>
    <tr>
        <td width="100">Judul Surat</td>
        <td width="25">:</td>
        <td width="auto">'.$dataArsip->dari_kepada.'</td>
    </tr>
    <tr>
        <td width="100">No. Surat</td>
        <td width="25">:</td>
        <td width="auto">'.$dataArsip->no_surat.'</td>
    </tr>
    <tr>
        <td width="100">Tgl. Surat</td>
        <td width="25">:</td>
        <td width="auto">'.date("d-m-Y", strtotime($dataArsip->tgl_surat)).'</td>
    </tr>
    <tr>
        <td width="100">Kode Surat</td>
        <td width="25">:</td>
        <td width="auto">'.$dataArsip->perihal.'</td>
    </tr>
</table>
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('kartu-indeks-'.$dataArsip->id_arsip.'.pdf', 'I');