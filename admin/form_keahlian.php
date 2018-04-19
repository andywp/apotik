<?php include'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Apotik Keahlian
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php 
	/**********************/
	/* form Tambah klinik */
	/**********************/
	if(@$_GET['page'] !='edit'){ 
		
		if(isset($_POST['simpan'])){			
			/* adodb_pr($_POST); */ 
			 $query="insert into keahlian set nama_keahlian='".$_POST['nama']."'";
			$simpan=$system->db->execute($query); 
			if($simpan){
				$error=alert('success','Data berhasil ditambah');
				$_POST=array();
			}else{
				$error=alert('error','Gagal menyimpan');
			}
		}
	?>
    <!-- Main content -->
    <section class="content">
		 <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Keahlian</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="nama"  placeholder="Nama Keahlian" required>
					</div>
				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<button type="submit" name="simpan" class="btn btn-primary">Submit</button>
				  </div>
            </form>
          </div>

    </section>
	
	<?php }else{
		/********************/
		/* halaman edit klinik*/ 
		/*******************/
		
		if(isset($_POST['update'])){			
			 /* adodb_pr($_FILES);  */
			  $query="Update keahlian set nama_keahlian='".$_POST['nama']."' where id_keahlian='".$_POST['id_keahlian']."' ";
			 
			
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil Ubah');
				/*pindah gambar ke directori*/
				
				
				$_POST=array();
			}else{
				$error=alert('error','Gagal menyimpan');
			}
		}
		
		
		$r=$system->db->getRow("select * from keahlian where id_keahlian='".$_GET['id']."'");
		/* adodb_pr($r);  */
	?>
	<!----- section edit apotik ------------------>
	<section class="content">
		 <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Keahlian</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="nama"  value="<?= $r['nama_keahlian'] ?>" placeholder="Nama dokter" required>
					</div>
				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" name="id_keahlian" value="<?= $r['id_keahlian'] ?>">
					<button type="submit" name="update" class="btn btn-primary">Submit</button>
				  </div>
            </form>
          </div>

    </section>		
	
	
	<?php } ?>
	
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'footer.php'; ?>