<?php include'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Apotik Klinik
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
			 $query="insert into dokter set nama_dokter='".$_POST['nama']."',alamat_dokter='".$_POST['alamat']."',jenis_kelamin='".$_POST['jenis_kelamin']."',id_keahlian='".$_POST['id_keahlian']."'  ";
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
              <h3 class="box-title">Tambah Data Dokter</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="nama"  placeholder="Nama dokter" required>
					</div>
					<div class="form-group">
					  <label>Alamat</label>
					  <input type="text" name="alamat" class="form-control"  placeholder="Alamat dokter" required>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						  <select name="jenis_kelamin" class="form-control select2" style="width: 100%;" required>
							<option>Pilih</option>
							<option value="Pria">Pria</option>
							<option value="Wanita">Wanita</option>
						  </select>
					</div>
					<div class="form-group">
						<?php
							$dokter=$system->db->getAll("select * from keahlian order by id_keahlian asc");
							$option='<option value="">Pilih Keahlian</option>';
							foreach($dokter as $d){
								$option.='<option value="'.$d[0].'">'.$d[1].'</option>';
							}
							
						?>
						<label>Dokter</label>
						  <select name="id_keahlian" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
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
			  $query="Update dokter set nama_dokter='".$_POST['nama']."',alamat_dokter='".$_POST['alamat']."',jenis_kelamin='".$_POST['jenis_kelamin']."',id_keahlian='".$_POST['id_keahlian']."' where no_id_dokter='".$_POST['id_dokter']."' ";
			 
			
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil Ubah');
				/*pindah gambar ke directori*/
				
				
				$_POST=array();
			}else{
				$error=alert('error','Gagal menyimpan');
			}
		}
		
		
		
		
		
		
		
		$r=$system->db->getRow("select * from dokter where no_id_dokter='".$_GET['id']."'");
		/* adodb_pr($r);  */
	?>
	<!----- section edit apotik ------------------>
	<section class="content">
		 <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Dokter</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="nama"  value="<?= $r['nama_dokter'] ?>" placeholder="Nama dokter" required>
					</div>
					<div class="form-group">
					  <label>Alamat</label>
					  <input type="text" name="alamat" class="form-control" value="<?= $r['alamat_dokter'] ?>"  placeholder="Alamat dokter" required>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						  <select name="jenis_kelamin" class="form-control select2" style="width: 100%;" required>
							<option>Pilih</option>
							<option value="Pria" <?php if($r['jenis_kelamin']=='Pria'){echo 'selected';} ?> >Pria</option>
							<option value="Wanita" <?php if($r['jenis_kelamin']=='Wanita'){echo 'selected';} ?>  >Wanita</option>
						  </select>
					</div>
					<div class="form-group">
						<?php
							$dokter=$system->db->getAll("select * from keahlian order by id_keahlian asc");
							$option='<option value="">Pilih Keahlian</option>';
							foreach($dokter as $d){
								if($r['id_keahlian']==$d[0]){
									$selected="selected";
								}else{
									$selected="";
								}
								
								
								$option.='<option value="'.$d[0].'" '.$selected.' >'.$d[1].'</option>';
							}
							
						?>
						<label>Dokter</label>
						  <select name="id_keahlian" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
					</div>
				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" name="id_dokter" value="<?= $r['no_id_dokter'] ?>">
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