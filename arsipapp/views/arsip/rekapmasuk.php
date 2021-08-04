<?php

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('REKAP SURAT MASUK');
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
    <th align="center" style="font-weight: bold; font-size: 1.5em">REKAP SURAT MASUK</th>
</tr>
</table>
<table border="1" cellpadding="3">
      <tr>
            <th rowspan="2" align="center" width="50">No</th>
            <th rowspan="2" align="center" width="50">M/K</th>
            <th colspan="2" align="center" width="200">Surat</th>
            <th rowspan="2" align="center" width="250">Kepada</th>
            <th rowspan="2" align="center" width="150">Hal</th>
            <th rowspan="2" align="center" width="auto">Kode</th>
      </tr>
      <tr>
            <th align="ceter">Nomor</th>
            <th align="ceter">Tanggal</th>
      </tr>
      ';

    //   <tr>
    //     <td></td>
    //     <td></td>
    //     <td></td>
    //     <td></td>
    //     <td></td>
    //     <td></td>
    //     <td></td>
    //   </tr>

$i = 1;
foreach ($dataArsip as $key => $value) {
    $html .= '<tr>';
    $html .= '<td>'.$i.'</td>';
    $html .= '<td>'.$value->jenis_surat.'</td>';
    $html .= '<td>'.$value->no_surat.'</td>';
    $html .= '<td>'.$value->tgl_surat.'</td>';
    $html .= '<td>'.$value->dari_kepada.'</td>';
    $html .= '<td>'.$value->perihal.'</td>';
    $html .= '<td>'.$value->kode_simpan.'</td>';
    $html .= '</tr>';
    $i++;
}
$html .= '
</table>
';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('rekap-surat-masuk-earsip.pdf', 'I');