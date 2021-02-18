<?php 
/**
 * Aplikasi Insentif
 * 
 * 
 * 
 * @author B.E.
 */
if (!isset($_GET['pg'])) {
	include 'dashboard.php';
} else {
	switch ($_GET['pg']) {
		case 'dashboard':
			include 'dashboard.php';
			break;

		case 'pggna':
			include 'dt_pengguna.php';
			break;

		case 'kssm':
			include 'dt_pengunjung.php';
			break;
		case 'masuk':
			include 'dt_kasmasuk.php';
			break;
		case 'keluar':
			include 'dt_kaskeluar.php';
			break;
		case 'transaksi':
			include 'dt_transaksi.php';
			break;
		case 'transmasuk':
			include 'dt_transmasuk.php';
			break;
		case 'transkeluar':
			include 'dt_transkeluar.php';
			break;
		
		case 'lapmasuk':
			include 'lap_transmasuk.php';
			break;

		case 'lapkeluar':
			include 'lap_transkeluar.php';
			break;
		case 'laprekap':
			include 'lap_rekapitulasi.php';
			break;	
		case 'cetak':
			include 'cetak_pdf.php';
			break;

		default:	        
	    	echo "<label>404 Halaman tidak ditemukan</label>";
	    break;
		
	}
}

?>