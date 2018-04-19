<?php include'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Admin
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
			 $query="insert into admin set username='".$_POST['username']."',password='".md5($_POST['password'])."'";
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
              <h3 class="box-title">Tambah Data Admin</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Username</label>
					  <input type="text" class="form-control" name="username"  placeholder="Nama Keahlian" required>
					</div>
					<div class="form-group">
					  <label>Password</label>
					  <input type="password" class="form-control" name="password"  placeholder="Nama Keahlian" required>
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
			 if(!empty($_POST['password'])){
				 $password=$system->db->getOne("select password from admin where id_admin='".$_GET['id']."'");
				 if($password==md5($_POST['password_lama'])){
					 $addQuer=" password='".$_POST['password']."'";
					 $query="Update admin set username='".$_POST['username']."' , password='".$_POST['password']."'  where id_admin='".$_GET['id']."' ";
					 
					 $simpan=$system->db->execute($query);
						if($simpan){
							$error=alert('success','Data berhasil Ubah');
							/*pindah gambar ke directori*/
							
							
							$_POST=array();
						}else{
							$error=alert('error','Gagal menyimpan');
						}
					 
				 }else{
					 $error=alert('error','Password tidak sama');
				 }
			 }else{
				 $query="Update admin set username='".$_POST['username']."'  where id_admin='".$_GET['id']."' ";
				 $simpan=$system->db->execute($query);
					if($simpan){
						$error=alert('success','Data berhasil Ubah');
						/*pindah gambar ke directori*/
						
						
						$_POST=array();
					}else{
						$error=alert('error','Gagal menyimpan');
					}
			 }
			 
			 
			 
			
			
		}
		
		
		$r=$system->db->getRow("select * from admin where id_admin='".$_GET['id']."'");
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
					  <label>Username</label>
					  <input type="text" class="form-control" name="username" value="<?= $r['username'] ?>"  placeholder="Nama Keahlian" required>
					</div>
					<div class="form-group">
					  <label>Password lama</label>
					  <input type="password" class="form-control" name="password_lama"  placeholder="Nama Keahlian" >
					</div>
					<div class="form-group">
					  <label>Password Baru</label>
					  <input type="password" class="form-control" name="password"  placeholder="Nama Keahlian" >
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