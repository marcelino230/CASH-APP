<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA transmasuk //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data transmasuk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=transmasuk&act=view">Data transmasuk</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=transmasuk&act=add"> <button type="button" class="btn btn-primary"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
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
                        <th>Jenis Kas Masuk</th>
                        <th>Keterangan</th>
                        <th>Nominal/Jumlah</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transmasuk r  join tblkasmasuk s 
                    on (s.id_kasmasuk=r.id_kasmasuk) order by kd_transmasuk asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tgl=tgl_indo($r['tgl']);?>
                        <td><?php echo "$r[kd_transmasuk]"?></td>
                        <td><?php echo "$tgl"?></td>
                        <td><?php echo "$r[nama]"?></td>
                        <td><?php echo "$r[detil]"?></td>
                        <td><?php echo "Rp.". number_format("$r[nominal]",'0','.','.')?></td>
                        <td><a href="?pg=transmasuk&act=edit&id=<?php echo $r['kd_transmasuk']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=transmasuk&act=delete&id=<?php echo $r['kd_transmasuk']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH DATA transmasuk //
      case 'add':
      if (isset($_POST['add'])) {

                $query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO transmasuk VALUES ('$_POST[kd_transmasuk]',
                '$_POST[tgl]',
                '$_POST[id_kasmasuk]','$_POST[detil]','$_POST[nominal]')");
                echo "<script>window.location='home.php?pg=transmasuk&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data transaksi kas masuk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=transmasuk&act=view">Data transaksi kas masuk</a></li>
            <li class="active"><a href="#">Tambah Data transaksi kas masuk</a></li>
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
                  <?php $kd_transmasuk= kd_transmasuk_auto(); //untuk kode otomatis dng fungsi?>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode Transaksi Kas Masuk</label>
                      <input type="text" class="form-control" id="kd" name="kd" placeholder="Nomor Penjualan" value="<?php echo $kd_transmasuk;?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="kd_transmasuk" name="kd_transmasuk" placeholder="Nomor Penjualan" value="<?php echo $kd_transmasuk;?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Transaksi</label>
                      <input class="form-control" id="date" name="tgl" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kas Masuk</label>
                      <select class="form-control select2" name="id_kasmasuk" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama kasmasuk ---">
                      <?php
                      $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblkasmasuk ORDER BY id_kasmasuk");
                      while($r=mysqli_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['id_kasmasuk']?>"><?php echo $r['nama'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan/Detail</label>
                      <input class="form-control" id="detil" name="detil" placeholder="Keterangan Lengkap tentang transaksi kas masuk" type="text"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Uang Masuk</label>
                      <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Jumlah Uang Masuk" required data-fv-notempty-message="Tidak boleh kosong">
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
      $d = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transmasuk WHERE kd_transmasuk='$_GET[id]'"));
            if (isset($_POST['update'])) {

           
              mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE transmasuk SET tgl='$_POST[tgl]',id_kasmasuk='$_POST[id_kasmasuk]',
               nominal='$_POST[nominal]',detil='$_POST[detil]' WHERE kd_transmasuk='$_POST[kd_transmasuk]'");
                echo "<script>window.location='home.php?pg=transmasuk&act=view'</script>";            
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data transaksi kas masuk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=transmasuk&act=view">Data transaksi kas masuk</a></li>
            <li class="active">Update Data transaksi kas masuk</li>
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
                      <label for="exampleInputEmail1">Kode Transaksi Kas Masuk</label>
                      <input type="text" class="form-control" id="kd_transmasuk" name="kd_transmasuk" placeholder="Nomor Penjualan" value= "<?php echo $d[kd_transmasuk];?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="kd_transmasuk" name="kd_transmasuk" placeholder="Nomor Penjualan" value= "<?php echo $d[kd_transmasuk];?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Transaksi</label>
                      <input class="form-control" id="date" name="tgl" value= "<?php echo $d[tgl];?>" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kas Masuk</label>
                      <select class="form-control select2" name="id_kasmasuk" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama kasmasuk ---">
                      <?php
                       $masuk=$d['id_kasmasuk'];
                      $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblkasmasuk ORDER BY id_kasmasuk");
                      while($r=mysqli_fetch_array($tampil)){
                        if($masuk==$r[id_kasmasuk]){
                         echo "<option value='$r[id_kasmasuk]' selected>" . $r['nama'] . "</option>";
                        } else {

                          echo "<option value='$r[id_kasmasuk]'>" . $r['nama'] . "</option>";
                        } 
                        }
                      ?>
                     
                      
                    </optgroup>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan/Detail</label>
                      <input class="form-control" id="detil" name="detil" value= "<?php echo $d[detil];?>" placeholder="Keterangan Lengkap tentang transaksi kas masuk" type="text"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Uang Masuk</label>
                      <input type="number" class="form-control" id="nominal" value= "<?php echo $d[nominal];?>" name="nominal" placeholder="Jumlah Uang Masuk" required data-fv-notempty-message="Tidak boleh kosong">
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

    // PROSES HAPUS DATA transmasuk //
      case 'delete':
      mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM transmasuk WHERE kd_transmasuk='$_GET[id]'");
      echo "<script>window.location='home.php?pg=transmasuk&act=view'</script>";
      break;

    }
    ?>