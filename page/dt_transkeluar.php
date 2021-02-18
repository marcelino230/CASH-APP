<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA transkeluar //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data transkeluar </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=transkeluar&act=view">Data transkeluar</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=transkeluar&act=add"> <button type="button" class="btn btn-primary"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Kas keluar</th>
                        <th>Keterangan</th>
                        <th>Nominal/Jumlah</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transkeluar r  join tblkaskeluar s 
                    on (s.id_kaskeluar=r.id_kaskeluar) order by kd_transkeluar asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$r[kd_transkeluar]"?></td>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[detil]"?></td>
                        <td><?php echo "Rp.". number_format("$r[nominal]",'0','.','.')?></td>
                        <td><a href="?pg=transkeluar&act=edit&id=<?php echo $r['kd_transkeluar']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=transkeluar&act=delete&id=<?php echo $r['kd_transkeluar']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
                    </tbody>
                  </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
	</div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->

      <?php
      break;
      // PROSES TAMBAH DATA transkeluar //
      case 'add':
      if (isset($_POST['add'])) {

                $query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO transkeluar VALUES ('$_POST[kd_transkeluar]',
                '$_POST[tgl]',
                '$_POST[id_kaskeluar]','$_POST[detil]','$_POST[nominal]')");
                echo "<script>window.location='home.php?pg=transkeluar&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data transaksi kas keluar </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=transkeluar&act=view">Data transaksi kas keluar</a></li>
            <li class="active"><a href="#">Tambah Data transaksi kas keluar</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                  <?php $kd_transkeluar= kd_transkeluar_auto(); //untuk kode otomatis dng fungsi?>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode Transaksi Kas keluar</label>
                      <input type="text" class="form-control" id="kd" name="kd" placeholder="Nomor Penjualan" value="<?php echo $kd_transkeluar;?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="kd_transkeluar" name="kd_transkeluar" placeholder="Nomor Penjualan" value="<?php echo $kd_transkeluar;?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Transaksi</label>
                      <input class="form-control" id="date" name="tgl" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kas keluar</label>
                      <select class="form-control select2" name="id_kaskeluar" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama kaskeluar ---">
                      <?php
                      $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblkaskeluar ORDER BY id_kaskeluar");
                      while($r=mysqli_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['id_kaskeluar']?>"><?php echo $r['nama'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan/Detail</label>
                      <input class="form-control" id="detil" name="detil" placeholder="Keterangan Lengkap tentang transaksi kas keluar" type="text"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Uang keluar</label>
                      <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Jumlah Uang keluar" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name ='add' class="btn btn-primary">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


      <?php
      break;
      // PROSES EDIT DATA KARYAWAN //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transkeluar WHERE kd_transkeluar='$_GET[id]'"));
            if (isset($_POST['update'])) {

           
              mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE transkeluar SET tgl='$_POST[tgl]',id_kaskeluar='$_POST[id_kaskeluar]',
               nominal='$_POST[nominal]',detil='$_POST[detil]' WHERE kd_transkeluar='$_POST[kd_transkeluar]'");
                echo "<script>window.location='home.php?pg=transkeluar&act=view'</script>";            
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data transaksi kas keluar </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=transkeluar&act=view">Data transaksi kas keluar</a></li>
            <li class="active">Update Data transaksi kas keluar</li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode Transaksi Kas keluar</label>
                      <input type="text" class="form-control" id="kd_transkeluar" name="kd_transkeluar" placeholder="Nomor Penjualan" value= "<?php echo $d[kd_transkeluar];?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="kd_transkeluar" name="kd_transkeluar" placeholder="Nomor Penjualan" value= "<?php echo $d[kd_transkeluar];?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Transaksi</label>
                      <input class="form-control" id="date" name="tgl" value= "<?php echo $d[tgl];?>" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kas keluar</label>
                      <select class="form-control select2" name="id_kaskeluar" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama kaskeluar ---">
                      <?php
                       $keluar=$d['id_kaskeluar'];
                      $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblkaskeluar ORDER BY id_kaskeluar");
                      while($r=mysqli_fetch_array($tampil)){
                        if($keluar==$r[id_kaskeluar]){
                         echo "<option value='$r[id_kaskeluar]' selected>" . $r['nama'] . "</option>";
                        } else {

                          echo "<option value='$r[id_kaskeluar]'>" . $r['nama'] . "</option>";
                        } 
                        }
                      ?>
                     
                      
                    </optgroup>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan/Detail</label>
                      <input class="form-control" id="detil" name="detil" value= "<?php echo $d[detil];?>" placeholder="Keterangan Lengkap tentang transaksi kas keluar" type="text"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Uang keluar</label>
                      <input type="number" class="form-control" id="nominal" value= "<?php echo $d[nominal];?>" name="nominal" placeholder="Jumlah Uang keluar" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-primary">Update</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


    <?php
    break;

    // PROSES HAPUS DATA transkeluar //
      case 'delete':
      mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM transkeluar WHERE kd_transkeluar='$_GET[id]'");
      echo "<script>window.location='home.php?pg=transkeluar&act=view'</script>";
      break;

    }
    ?>