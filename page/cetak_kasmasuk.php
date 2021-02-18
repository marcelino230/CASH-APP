<?php
// sesuai kan root file mPDF anda
$nama_dokumen='Laporan Penjualan MCC'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

//Tuliskan file HTML di bawah sini , sesuai File anda .
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<?php

// Koneksi ke database //

error_reporting(0);
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";

$tgltransmasukaw = $_POST[tgltransmasukaw];
$tgltransmasukak = $_POST[tgltransmasukak];
 

$tglaw=tgl_indo($tgltransmasukaw);
$tglak=tgl_indo($tgltransmasukak);
 
?>

<!--CONTOH Code START-->
<table border='0' align='LEFT'>
<tr>
<th>
<img src="../dist/img/logo.jpg"  align="left" width='110' height='100px' >
</th>
<th width="20">
</th>
<th width="900px" align="left">
<h2> <left> LAPORAN PENERIMAAN KAS PT. INDOMARCO CIREBON<br> </left><center> <?php echo "TANGGAL $tglaw SAMPAI  $tglak" ?> </center></h2>

</th>
</tr>
</table>
<hr style="height:8px;" />

<br>
<h3 style="text-align:center;"> Laporan Penerimaan Kas </h3>


<table cellspacing="0" cellpadding="5" border="1">
                        
                          <tr>
                         <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Kas Masuk</th>
                        <th>Keterangan</th>
                        <th>Nominal/Jumlah</th>

                       <!--
                        <th>Edit</th>
                        <th>Delete</th>
                        -->
                            </tr>
                            </thead>
                            <tbody>
                    <?php
                    
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transmasuk r  join tblkasmasuk s 
                    on (s.id_kasmasuk=r.id_kasmasuk)
                        WHERE r.tgl BETWEEN  '$_POST[tgltransmasukaw]' AND  '$_POST[tgltransmasukak]'
                        ORDER BY kd_transmasuk ASC");
                    $no = 1;
                        
                      while ($r=mysqli_fetch_array($tampil)){ 
                        ?>

                        <tr>
                        <td><center><?php echo "$no"?></center></td>
                          <?php  $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$r[kd_transmasuk]"?></td>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[detil]"?></td>
                        <td><?php echo "Rp.". number_format("$r[nominal]",'0','.','.')?></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    <tr>
                        <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(nominal) as total_transmasuk FROM transmasuk
                       
                        where  tgl BETWEEN '$_POST[tgltransmasukaw]' AND  '$_POST[tgltransmasukak]'
                       
                        ORDER BY kd_transmasuk ASC"));
                        ?>

                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_transmasuk]",'0','.','.')?></td>
                        
                        </tr>
                        </tbody>
                      </table>
                      
                                    <br> <br>
                      
                      <br>
        <br>
        <table border='0' align='right'>
<tr>
<br>
<th><?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 420px;"> Cirebon, <?php echo "$tanggal"?>
<h4> <center> </center></h4> 
<br>
<br>
<br>
<br>
Manager
</th>
</tr>
</table>

<?php
//Batas file sampe sini
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//$stylesheet = file_get_contents('css/zebra.css');
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>