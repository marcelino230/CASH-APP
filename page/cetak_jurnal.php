<?php
// sesuai kan root file mPDF anda
$nama_dokumen='Rekap Laporan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

//Tuliskan file HTML di bawah sini , sesuai File anda .
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->

<h2 style="text-align:center;"> &nbsp;&nbsp;KIDS FUN THE LOST CITY KUNINGAN </h2>
<hr style="height:8px;" />

<br>
<h3 style="text-align:center;"> JURNAL BUKU BESAR PENCATATAN PENERIMAAN KAS | KIDS FUN THE LOST CITY KUNINGAN</h3>

<?php

// Koneksi ke database //

error_reporting(0);
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tglpenjualanaw];
$tglpenjualanak = $_POST[tglpenjualanak];
?>


<table cellspacing="5" cellpadding="5" border="1">
                        
                          <tr>
                            <th>No</th>
                            <th width="20%">Tanggal</th>
                            <th width="20%">Nama Pengunjung</th>
                            <th width="20%">Uraian</th>
                            <th width="20%">Debit</th>
                            <th>Kredit</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblrealisasi r JOIN tblpengunjung s ON ( s.id_pengunjung = r.id_pengunjung ) 
                        WHERE  tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                       
                        ORDER BY nopenjualan ASC");
                        $no = 1;
                          while ($r=mysqli_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td rowspan="2"><?php echo "$no"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                            
                            <td rowspan="2" align="center"><?php echo "$tglpenjualan"?></td>
                            <td rowspan="2" align="center"><?php echo "$r[nmpengunjung]"?></td>
                            <td><?php echo "Beban Penjualan "?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                            <td><?php echo "------"?></td>
                            </tr>
                            <tr>
                            <td><?php echo "Penjualan dibayar dimuka "?></td>
                            <td><?php echo "------"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>
                        

                        <tr>
                        <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                         <?php
                        
                        $liatHarga=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(total_penjualan) as total FROM tblrealisasi
                       
                        where  tglpenjualan BETWEEN '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                       
                        ORDER BY nopenjualan ASC"));
                        ?>

                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>                      
                      
                      <br> <br>
                      <?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 490px;"> Cirebon, <?php echo "$tanggal"?>
                      <br><br><br><br><br><br>
                      MANAGER </p>

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