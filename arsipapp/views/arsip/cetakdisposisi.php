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

<table  cellpadding="10">
    <tr>
        <th colspan="6" align="center" style="font-weight: bold; font-size: 1.5em">KARTU DISPOSISI</th>
    </tr>
    <tr>
        <td width="12%">Indeks</td>
        <td width="4.5%">:</td>
        <td width="50%">'.$indeks.'</td>

        <td width="12%">Kode</td>
        <td width="4.5%">:</td>
        <td width="auto">'.$kodeSimpan.'</td>
    </tr>
</table>

<table cellpadding="6">
    <tr>
        <td width="150">Tanggal / nomor</td>
        <td width="20">:</td>
        <td width="auto">'.date("d-m-Y", strtotime($tglSurat)).' / '.$noSurat.'</td>
    </tr>
    <tr>
        <td width="150">Asal Surat</td>
        <td width="20">:</td>
        <td width="auto">'.$dariKepada.'</td>
    </tr>
    <tr>
        <td width="150">Isi Ringkas</td>
        <td width="20">:</td>
        <td width="auto">'.$isiRingkasan.'</td>
    </tr>
    <tr>
        <td width="150">Diterima Tanggal</td>
        <td width="20">:</td>
        <td width="auto">'.$tglSimpan.'</td>
    </tr>
    <tr>
        <td width="150">Tanggal Penyelesaian</td>
        <td width="20">:</td>
        <td width="auto">'.$tglPenyelesaian.'</td>
    </tr>
    <tr>
        <td colspan="3" width="auto">'.$isiDisposisi.'</td>
    </tr>
</table>

<table cellpadding="6">
    <tr>
        <td width="60%"></td>
        <td width="40%">
            Diteruskan kepada :
            <ol>';

foreach ($kepada as $key => $value) {
    $html .= '<li>';
    $html .= $value;
    $html .= '</li>';
}

$html .= '
            </ol>
        </td>
    </tr>
    <tr>
        <td colspan="2">Sesudah digunakan harap dikembalikan kepada :<br/>
            '.$dikembalikanKe.'
        </td>
    </tr>
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('kartu-disposisi-'.$idArsip.'.pdf', 'I');