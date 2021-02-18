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

$tgltransaw = $_POST[tgltransaw];
$tgltransak = $_POST[tgltransak];
 

$tglaw=tgl_indo($tgltransaw);
$tglak=tgl_indo($tgltransak);
 
?>

<!--CONTOH Code START-->
<table border='0' align='LEFT'>
<tr>
<th>
<img src="../dist/img/logo.png"  align="left" width='110' height='100px' >
</th>
<th width="20">
</th>
<th width="900px" align="left">
<h2> <left> LAPORAN PEMASUKAN DAN PENGELUARAN KAS PT. PGAS INDONESIA CABANG CIREBON<br> </left><center> <?php echo "TANGGAL $tglaw SAMPAI  $tglak" ?> </center></h2>

</th>
</tr>
</table>
<hr style="height:8px;" />

<br>
<h3 style="text-align:center;"> Laporan Pemasukan dan Pengeluaran Kas </h3>


<table cellspacing="0" cellpadding="5" border="1">
              
                        <tr>
                        <th><center> NO </center></th>
                        <th><center>TANGGAL</center></th>
                        <th><center>KODE VOUCHER</center></th>
                        <th><center>URAIAN</center></th>
                        <th><center>PENGELUARAN</center></th>
                        <th><center>PEMASUKAN</center></th>
                        <th><center>SALDO</center></th>
                      </tr>
                       
                     <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT tbltransaksi.*,tblkasmasuk.*,tblkasmasuk.nama as namamasuk, tblkaskeluar.*,
                    tblkaskeluar.nama as namakeluar, tbljeniskas.* FROM tbltransaksi LEFT  join tblkasmasuk  on tbltransaksi.id_kasmasuk=tblkasmasuk.id_kasmasuk LEFT join tblkaskeluar ON tblkaskeluar.id_kaskeluar=tbltransaksi.id_kaskeluar INNER JOIN
                    tbljeniskas ON tbltransaksi.id_jeniskas=tbljeniskas.id_jeniskas WHERE tbltransaksi.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' GROUP BY tbltransaksi.kd_transaksi  ");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){

                         if($r[namamasuk]=='0'){
                          $kasmasuk= " - ";
                        } else{
                          $kasmasuk=$r[namamasuk];
                        }
                        if($r[namakeluar]=='0'){
                          $kaskeluar=" - ";  
                        } else{
                         $kaskeluar=$r[namakeluar];
                         }  

                         if($r[id_jeniskas]=='1'){
                          $nominalmasuk=$r[nominal];
                         } else {
                          $nominalmasuk="-";
                         }
                         if($r[id_jeniskas]=='2') {
                          $nominalkeluar=$r[nominal];
                         } else {
                          $nominalkeluar="-";
                         }
                         //$saldo=$nominalmasuk-$nominalkeluar;
                         if($no==1){
                         $saldo=$nominalmasuk-$nominalkeluar;
                         } else {
                          $saldo=$saldo+($nominalmasuk-$nominalkeluar);
                        }
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[kd_transaksi]"?></td>
                         <td><?php echo "$r[ket]"?></td>
                         <td><?php echo "Rp. " . number_format("$nominalkeluar",'0','.','.')?></td>
                        <td><?php echo "Rp. " . number_format("$nominalmasuk",'0','.','.')?></td>
                        <td><?php echo "Rp. " . number_format("$saldo",'0','.','.')?></td>
                       <!-- <td><a href="?pg=trans&act=edit&id=<?php echo $r['kd_trans']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=trans&act=delete&id=<?php echo $r['kd_trans']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        -->
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>

                    <tr>
                    <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                    <?php
                    
                    $liatkeluar=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(nominal) as nominal
                    FROM tbltransaksi t join tblkaskeluar k on (t.id_kaskeluar=k.id_kaskeluar) 
                    WHERE t.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' 
                    "));

                    $liatmasuk=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(nominal) as nominal
                    FROM tbltransaksi t join tblkasmasuk m on (t.id_kasmasuk=m.id_kasmasuk) 
                    WHERE t.tgl BETWEEN  '$_POST[tgltransaw]' AND  '$_POST[tgltransak]' 
                   "));
                    
                    $saldoakhir=$liatmasuk[nominal]-$liatkeluar[nominal];

                    ?>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$liatkeluar[nominal]",'0','.','.')?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$liatmasuk[nominal]",'0','.','.')?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp. ".number_format("$saldoakhir",'0','.','.')?></td>
                    </tr>
                    
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