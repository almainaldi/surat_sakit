<?php
require_once("tcpdf/tcpdf.php");
ob_start();

include_once('class/surat_rujukan.php');

$surat_rujukan   = new surat_rujukan();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($surat_rujukan->cek_id($id)) {
        $data = $surat_rujukan->get_by_id($id);
    } else {
        header("location:tampil_surat_rujukan?pesan=gagal");
    }
} else {
    header("location:tampil_surat_rujukan");
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Aldi Almain');
$pdf->setTitle('Surat Rujukan');
$pdf->setSubject('LPS');
$pdf->setKeywords('LPS, PDF, example, test, guide');

// set default header data
// $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
// $pdf->setFooterData(array(0,64,0), array(0,0,0));

// set header and footer fonts
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
// $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
// $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// set default font subsetting mode
// $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$fontname = TCPDF_FONTS::addTTFfont('ubuntu.ttf', 'TrueTypeUnicode', '', 96);
$fontbold = TCPDF_FONTS::addTTFfont('ubuntuB.ttf', 'TrueTypeUnicode', '', 96);
$pdf->setFont('freesans', '', 16, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// $pdf->Write(0, 'SURAT PERINTAH KERJA (SPK) - MTC', 'B', 0, 'C', true, 0, false, false, 0);
// Set some content to print
$html = '<html><head><link rel="stylesheet" href="assets/master/bower_components/bootstrap/dist/css/bootstrap.min.css"></head><body><table>
<tbody>
<tr>
<td align="left"><img src="tcpdf/examples/images/logo.jpg" width="100"/></td>
</tr>
</tbody><br>
<tbody><tr><td align="center"><strong>SURAT RUJUKAN</strong></td></tr>';
$html .= '</tbody><br>
<tbody>
<tr>
<td><p>Yang bernama di bawah ini :</p></td>
</tr>
</tbody><br>
<tbody>
<tr>
	<td width="150px">Nama Karyawan</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['nama_kar'] . '</td>
</tr>
<tr>
	<td width="150px">Jabatan</td>
	<td width="10px">:</td>
	<td width="200px">' . $data['jabatan'] . '</td>
</tr>
<tr>
	<td width="150px">Keluhan</td>
	<td width="10px">:</td>
	<td width="200px">' . $data['keluhan'] . '</td>
</tr>
</tbody></table><br><br>';
$html .= '<br><table><tbody>
<tr>
<td><p>Diberikan izin berobat ke '.$data['tujuan'].' untuk dapat diperiksa oleh dokter.</p></td>
</tr>
<br>
</tbody>
</table><br><br>';

$html .= '<br><br><table class="table" style="font-size:15px;">
<tr>
<td class="text" style="width: 50%;" align="center"></td>
<td class="text" style="width: 50%;" align="center"><b>Jakarta, '.$data['tanggal'].'</b></td>
</tr>
<tr>
<td class="text" style="width: 50%;" align="center">Yang Mengetahui,<br><br><br><br><br><br></td>
<td class="text" style="width: 50%;" align="center">Pemberi Kuasa<br><br><br><br><br><br></td>
</tr>';
$html .= '<br><br><table class="table" style="font-size:15px;">
<tr>
<td class="text" style="width: 50%;" align="center"><b> (' . $data['mengetahui'] . ')</b></td>
<td class="text" style="width: 50%;" align="center"><b> (' . $data['pemberi'] . ')</b></td>
</tr>';
$html .= "</table></body></html>";

echo $html;
$content = ob_get_contents();

// Print text using writeHTMLCell()
// $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 0, 0, true, '', true);
$pdf->writeHTML($content, true, false, true, false, '');
$pdf_name = '' . $data['nama_kar'] . ' - ' . $data['tanggal'] . '.pdf';
// $pdf->Ln(5);
// $pdf->Cell(44, 4, 'Penerima Kuasa', 1,0);
// $pdf->Cell(40, 4, 'Pemberi Tugas', 1,0);
// $pdf->Cell(40, 4, 'Yang Mengerjakan', 1,0);
// $pdf->Cell(48, 4, 'Yang Mengetahui', 1,0);
// draw jpeg image
$pdf->setAlpha(0.2);
$pdf->Image('tcpdf/examples/images/logo.jpg', 75, 100, 60, 60, '', '', '', true, 450);

// restore full opacity

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
// $pdf->Output(''.$pdf_name.'', 'D');

ob_end_clean();
$pdf->Output('Surat Rujukan - ' . $pdf_name . '', 'I');
exit(0);
ob_end_flush();


//============================================================+
// END OF FILE
//============================================================+
