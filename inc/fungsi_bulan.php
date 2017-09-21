<?php	
function tampil_bulan($x) {
		if ($x == 1 ) {
			$bulan = "Januari"; }
		if ($x == 2 ) {
			$bulan = "Februari"; }
		if ($x == 3 ) {
			$bulan = "Maret"; }
		if ($x == 4 ) {
			$bulan = "April"; }
		if ($x == 5 ) {
			$bulan = "Mei"; }
		if ($x == 6 ) {
			$bulan = "Juni"; }
		if ($x == 7 ) {
			$bulan = "Juli"; }
		if ($x == 8 ) {
			$bulan = "Agustus"; }
		if ($x == 9 ) {
			$bulan = "September"; }
		if ($x == 10) {
			$bulan = "Oktober"; }
		if ($x == 11) {
			$bulan = "November"; }
		if ($x == 12) {
			$bulan = "Desember"; }
		return $bulan;
	}
?>