<?php
require_once("tcpdf/tcpdf.php");
ob_start();

include_once('class/rekap_berobat.php');
include_once('class/detail_data_berobat.php');
$rekap_berobat = new rekap_berobat();
$detail_data_berobat = new detail_data_berobat();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($rekap_berobat->cek_id($id)) {
        $data = $rekap_berobat->get_by_id($id);
    } else {
        header("location:tampil_rekap_berobat?pesan=gagal");
    }
} else {
    header("location:tampil_rekap_berobat?pesan=gagal");
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Aldi Almain');
$pdf->setTitle('Rekam Medis');
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
$html = '<html><head><link rel="stylesheet" href="assets/master/bower_components/bootstrap/dist/css/bootstrap.min.css"></head><body><table><tbody><tr><td align="center"><strong>REKAM MEDIS KARYAWAN</strong></td></tr>';
$html .= '</tbody><br><tbody>
<tr>
	<td width="150px">Tanggal</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['tanggal'] . '</td>
</tr>
<tr>
	<td width="150px">Nama Karyawan</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['nama_kar'] . '</td>
</tr>
<tr>
	<td width="150px">Jabatan</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['jabatan'] . '</td>
    </tr>
<tr>
    <td width="150px">Nama Klinik</td>
    <td width="10px">:</td>
    <td width="500px">' . $data['tempat'] . '</td>
</tr>
<tr>	
	<td width="150px">Dokter</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['dokter'] . '</td>
</tr>
<tr>
	<td width="150px">Keluhan Sakit</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['keluhan'] . '</td>
</tr>
<tr>
	<td width="150px">Diagnosa</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['diagnosis'] . '</td>
</tr>
<tr>
	<td width="150px">Solusi Untuk Pasien</td>
	<td width="10px">:</td>
	<td width="500px">' . $data['solusi'] . '</td>
</tr>
<tr>
	<td width="150px">Kasbon</td>
	<td width="10px">:</td>
	<td width="500px">Rp. ' . number_format($data['kasbon'], 0, "", ".") . '</td>
</tr>
<tr>
	<td width="150px">Kembali</td>
	<td width="10px">:</td>
	<td width="500px">Rp. ' . number_format($data['kasbon'] - $data['total_biaya'], 0, "", ".") . '</td>
</tr>
</tbody></table><br><br>';
$html .= '<br><table class="table table-hover table-borderless" border="1" style="padding: 5px;"><thead>
			<tr style="vertical-align : middle;text-align:center; font-size: 14px;">
			<th width="10%">No.</th>
			<th width="45%">Jenis Layanan</th>
			<th width="45%">Biaya</th>
			</tr>
			</thead>';

            $id_berobat = $data['id_biaya_berobat'];
            $data_detail_data_berobat      = $detail_data_berobat->tampil_data($id_berobat);
            $total_biaya      = $detail_data_berobat->total_biaya($id_berobat);
            if ($data_detail_data_berobat->num_rows > 0) {
                $no = 1;
                while ($row = mysqli_fetch_object($data_detail_data_berobat)) {
        $html .= '<tbody><tr style="vertical-align : middle;text-align:center; font-size: 14px;">
									<th width="10%">' . $no . '</th>
									<th width="45%">' . $row->jenis_layanan . '</th>
									<th width="45%">Rp. ' . number_format($row->biaya, 0, "", ".") . '</th>
								</tr>';
        $no++;
    }
}
$html .= '
<tr>
<th colspan="2" style="vertical-align : middle;text-align:center; font-size: 14px;">Total Biaya</th>
<th colspan="1" style="vertical-align : middle;text-align:center; font-size: 14px;">Rp. ' . number_format($total_biaya, 0, "", ".") . '</th>
</tr>
</tbody>';
$html .= "</table></body></html>";

echo $html;
$content = ob_get_contents();

// Print text using writeHTMLCell()
// $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 0, 0, true, '', true);
$pdf->writeHTML($content, true, false, true, false, '');
$pdf_name = 'Rekam Medis ' . $data['tanggal'] . ' ' . $data['nama_kar'] . '.pdf';
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
$pdf->Output('' . $pdf_name . '', 'I');
exit(0);
ob_end_flush();


//============================================================+
// END OF FILE
//============================================================+
