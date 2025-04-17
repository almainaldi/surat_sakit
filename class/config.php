<?php
class config
{
	function tanggal_indo($tanggal)
	{
		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);
		/*$bulan = array('01'=>'01',
			'02'=>'02',
			'03'=>'03',
			'04'=>'04',
			'05'=>'05',
			'06'=>'06',
			'07'=>'07',
			'08'=>'08',
			'09'=>'09',
			'10'=>'10',
			'11'=>'11',
			'12'=>'12');*/


		//2018-05-27
		//27-bulan-2018
		$pecah_tanggal = explode('-', $tanggal);
		//return $pecah_tanggal[0].' '.$bulan[$pecah_tanggal['1']].' '.$bulan[$pecah_tanggal['2']].' '.$bulan[$pecah_tanggal['3']];
		//return $pecah_tanggal[0].' '.$bulan[$pecah_tanggal['1']].' '.$pecah_tanggal['2'];
		return $pecah_tanggal[2] . ' ' . $bulan[$pecah_tanggal['1']] . ' ' . $pecah_tanggal['0'];
	}

	function hari_ini()
	{
		$hari = date("D");

		switch ($hari) {
			case 'Sun':
				$hari_ini = "Minggu";
				break;

			case 'Mon':
				$hari_ini = "Senin";
				break;

			case 'Tue':
				$hari_ini = "Selasa";
				break;

			case 'Wed':
				$hari_ini = "Rabu";
				break;

			case 'Thu':
				$hari_ini = "Kamis";
				break;

			case 'Fri':
				$hari_ini = "Jumat";
				break;

			case 'Sat':
				$hari_ini = "Sabtu";
				break;

			default:
				$hari_ini = "Tidak di ketahui";
				break;
		}

		return $hari_ini;
	}

	function bln()
	{
		$bulan = date("m");

		switch ($bulan) {
			case '01':
				$bln_ini = "I";
				break;

			case '02':
				$bln_ini = "II";
				break;

			case '03':
				$bln_ini = "III";
				break;

			case '04':
				$bln_ini = "IV";
				break;

			case '05':
				$bln_ini = "V";
				break;

			case '06':
				$bln_ini = "VI";
				break;

			case '07':
				$bln_ini = "VII";
				break;

			case '08':
				$bln_ini = "VIII";
				break;

			case '09':
				$bln_ini = "IX";
				break;

			case '10':
				$bln_ini = "X";
				break;

			case '11':
				$bln_ini = "XI";
				break;

			case '12':
				$bln_ini = "XII";
				break;

			default:
				$bln_ini = "Tidak di ketahui";
				break;
		}

		return $bln_ini;
	}
	function bln2($hasil_bulan)
	{
		$bulan = $hasil_bulan;

		switch ($bulan) {
			case '01':
				$bln_ini = "I";
				break;

			case '02':
				$bln_ini = "II";
				break;

			case '03':
				$bln_ini = "III";
				break;

			case '04':
				$bln_ini = "IV";
				break;

			case '05':
				$bln_ini = "V";
				break;

			case '06':
				$bln_ini = "VI";
				break;

			case '07':
				$bln_ini = "VII";
				break;

			case '08':
				$bln_ini = "VIII";
				break;

			case '09':
				$bln_ini = "IX";
				break;

			case '10':
				$bln_ini = "X";
				break;

			case '11':
				$bln_ini = "XI";
				break;

			case '12':
				$bln_ini = "XII";
				break;

			default:
				$bln_ini = "Tidak di ketahui";
				break;
		}

		return $bln_ini;
	}

	function bln_tf($bln_tf)
	{
		$bulan = $bln_tf;

		switch ($bulan) {
			case '01':
				$bln_ini = "Januari";
				break;

			case '02':
				$bln_ini = "Februari";
				break;

			case '03':
				$bln_ini = "Maret";
				break;

			case '04':
				$bln_ini = "April";
				break;

			case '05':
				$bln_ini = "Mei";
				break;

			case '06':
				$bln_ini = "Juni";
				break;

			case '07':
				$bln_ini = "Juli";
				break;

			case '08':
				$bln_ini = "Agustus";
				break;

			case '09':
				$bln_ini = "September";
				break;

			case '10':
				$bln_ini = "Oktober";
				break;

			case '11':
				$bln_ini = "November";
				break;

			case '12':
				$bln_ini = "Desember";
				break;

			default:
				$bln_ini = "Tidak di ketahui";
				break;
		}

		return $bln_ini;
	}
	function bulan($bln)
	{
		$bulan = $bln;

		switch ($bulan) {
			case '01':
				$bln_ini = "Januari";
				break;

			case '02':
				$bln_ini = "Februari";
				break;

			case '03':
				$bln_ini = "Maret";
				break;

			case '04':
				$bln_ini = "April";
				break;

			case '05':
				$bln_ini = "Mei";
				break;

			case '06':
				$bln_ini = "Juni";
				break;

			case '07':
				$bln_ini = "Juli";
				break;

			case '08':
				$bln_ini = "Agustus";
				break;

			case '09':
				$bln_ini = "September";
				break;

			case '10':
				$bln_ini = "Oktober";
				break;

			case '11':
				$bln_ini = "November";
				break;

			case '12':
				$bln_ini = "Desember";
				break;

			default:
				$bln_ini = "Tidak di ketahui";
				break;
		}

		return $bln_ini;
	}
	function bulan1($hasil_bulan)
	{
		$bulan = $hasil_bulan;

		switch ($bulan) {
			case '01':
				$bln_ini = "Januari";
				break;

			case '02':
				$bln_ini = "Februari";
				break;

			case '03':
				$bln_ini = "Maret";
				break;

			case '04':
				$bln_ini = "April";
				break;

			case '05':
				$bln_ini = "Mei";
				break;

			case '06':
				$bln_ini = "Juni";
				break;

			case '07':
				$bln_ini = "Juli";
				break;

			case '08':
				$bln_ini = "Agustus";
				break;

			case '09':
				$bln_ini = "September";
				break;

			case '10':
				$bln_ini = "Oktober";
				break;

			case '11':
				$bln_ini = "November";
				break;

			case '12':
				$bln_ini = "Desember";
				break;

			default:
				$bln_ini = "Tidak di ketahui";
				break;
		}

		return $bln_ini;
	}
	function bulan2($hasil_bulan1)
	{
		$bulan = $hasil_bulan1;

		switch ($bulan) {
			case '01':
				$bln_ini = "Januari";
				break;

			case '02':
				$bln_ini = "Februari";
				break;

			case '03':
				$bln_ini = "Maret";
				break;

			case '04':
				$bln_ini = "April";
				break;

			case '05':
				$bln_ini = "Mei";
				break;

			case '06':
				$bln_ini = "Juni";
				break;

			case '07':
				$bln_ini = "Juli";
				break;

			case '08':
				$bln_ini = "Agustus";
				break;

			case '09':
				$bln_ini = "September";
				break;

			case '10':
				$bln_ini = "Oktober";
				break;

			case '11':
				$bln_ini = "November";
				break;

			case '12':
				$bln_ini = "Desember";
				break;

			default:
				$bln_ini = "Tidak di ketahui";
				break;
		}

		return $bln_ini;
	}

	
}
