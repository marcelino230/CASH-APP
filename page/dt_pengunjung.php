<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA USER //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data pengunjung </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=kssm&act=view">Data pengunjung</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=kssm&act=add"> <button type="button" class="btn btn-primary"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No KTP</th>
                        <th>Nama pengunjung</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblpengunjung order by id_pengunjung asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[noktp]"?></td>
                        <td><?php echo "$r[nmpengunjung]"?></td>
                        
                        <?php
                        if ($r['jenkel']=="L"){
                          $jenkel = "Laki-laki";
                        } else {
                          $jenkel = "Perempuan";
                        }
                        ?>

                        <td><?php echo "$jenkel"?></td>
                        <td><?php echo "$r[alamat]"?></td>
                        <td><a href="?pg=kssm&act=edit&id=<?php echo $r['id_pengunjung']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=kssm&act=delete&id=<?php echo $r['id_pengunjung']?>"><button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
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
      // PROSES TAMBAH DATA pengunjung //
      case 'add':
      if (isset($_POST['add'])) {
                $query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO tblpengunjung VALUES ('','$_POST[noktp]',
                '$_POST[nmpengunjung]','$_POST[jenkel]','$_POST[alamat]')");
                echo "<script>window.location='home.php?pg=kssm&act=view'</script>";
              }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data pengunjung </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=kssm&act=view">Data pengunjung</a></li>
            <li class="active"><a href="#">Tambah Data pengunjung</a></li>
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
                      <label for="exampleInputEmail1">No KTP</label>
                      <input type="text" class="form-control" id="noktp" name="noktp" placeholder="Nomor KTP" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama pengunjung</label>
                      <input type="text" class="form-control" id="nmpengunjung" name="nmpengunjung" placeholder="Nama pengunjung" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kelamin</label> <br>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="L" required data-fv-notempty-message="Tidak boleh kosong"> Laki-Laki 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="P" required data-fv-notempty-message="Tidak boleh kosong"> Perempuan
                      </label>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5" placeholder="Alamat" required data-fv-notempty-message="Tidak boleh kosong"></textarea>
                   	</div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'add' class="btn btn-primary">Simpan</button>
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
      // PROSES EDIT DATA pengunjung //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM tblpengunjung WHERE id_pengunjung='$_GET[id]'"));
            if (isset($_POST['update'])) {
              mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE tblpengunjung SET noktp='$_POST[noktp]', 
                nmpengunjung='$_POST[nmpengunjung]',jenkel='$_POST[jenkel]'
                ,alamat='$_POST[alamat]' WHERE id_pengunjung='$_POST[id]'");
                echo "<script>window.location='home.php?pg=kssm&act=view'</script>";
            
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data pengunjung </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=kssm&act=view">Data pengunjung</a></li>
            <li class="active">Update Data pengunjung</li>
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
                  	  <input type="hidden" name="id" value= "<?php echo $d['id_pengunjung'];?>">
                      <label for="exampleInputEmail1">No KTP</label>
                      <input type="text" class="form-control" id="noktp" name="noktp" placeholder="No KTP" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['noktp'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama pengunjung</label>
                      <input type="text" class="form-control" id="nmpengunjung" name="nmpengunjung" placeholder="Nama pengunjung" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nmpengunjung'];?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kelamin</label> <br>
                      <?php
                      if ($d['jenkel'] == 'L'){
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="L" required data-fv-notempty-message="Tidak boleh kosong" checked> Laki-laki 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="P" required data-fv-notempty-message="Tidak boleh kosong"> Perempuan
                      </label>
                      <?php
                      } else {
                      ?>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="L" required data-fv-notempty-message="Tidak boleh kosong"> Laki-laki 
                      </label>
                      <label class="radio-inline">
                      <input type="radio" name="jenkel" id="jenkel" value="P" required data-fv-notempty-message="Tidak boleh kosong" checked> Perempuan
                      </label>
                      <?php
                      }
                      ?>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5" placeholder="Alamat" required data-fv-notempty-message="Tidak boleh kosong"><?php echo $d[alamat]?></textarea>
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

    // PROSES HAPUS DATA pengunjung //
      case 'delete':
      mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM tblpengunjung WHERE id_pengunjung='$_GET[id]'");
      echo "<script>window.location='home.php?pg=kssm&act=view'</script>";
      break;

    }
    ?>