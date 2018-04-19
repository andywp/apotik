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
			if(!empty($_POST['foto'])){
				$lokasi_file=$_FILES['foto']['tmp_name'];
				$tipe_file   = $_FILES['foto']['type'];
				$gambar   = $_FILES['foto']['name'];
				//$direktori   = "../config/gambar/$gambar";
				$rename=date("dmYhis");
				$ext = strtolower(end(explode('.', $_FILES['foto']['name'])));
				$direktori   ="upload/".$rename.".".$ext;
				$new=$rename.".".$ext;
				move_uploaded_file($lokasi_file,$direktori);
			}else{
				$new=$_POST['old'];
			}
			
			/* adodb_pr($_POST); */
			$query="insert into klinik set nama_klinik='".$_POST['nama']."' ,alamat_klinik='".$_POST['alamat']."', no_telp='".$_POST['no_telp']."',foto_klinik='".$new."',deskripsi_klinik='".$_POST['desk']."',jam_operasional='".$_POST['jop']."',latitude='".$_POST['lat']."', longitude='".$_POST['lng']."', no_id_dokter='".$_POST['dokter']."'    ";
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil ditambah');
				/*pindah gambar ke directori*/
				
				move_uploaded_file($lokasi_file,$direktori);
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
              <h3 class="box-title">Tambah Data Klinik</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="nama"  placeholder="Nama Klinik" required>
					</div>
					<div class="form-group">
					  <label>Alamat</label>
					  <input type="text" name="alamat" class="form-control"  placeholder="Alamat Klinik" required>
					</div>
					<div class="form-group">
					  <label>No Telpon</label>
					  <input type="text" name="no_telp" class="form-control"  placeholder="Alamat Klinik" required>
					</div>
					<div class="form-group">
					  <label>Foto</label>
					  <input type="file" name="foto" required>
					  <p class="help-block">Upload Gambar.</p>
					</div>
					<div class="form-group">
					  <label>Deskripsi</label>
					  <textarea class="form-control" name="desk" rows="3" placeholder="Deskripsi ..." required></textarea>
					</div>
					<div class="form-group">
						<label>Jam Operasi</label>
						  <select name="jop" class="form-control select2" style="width: 100%;" required>
							<option>Pilih</option>
							<option value="1">24 Jam</option>
							<option value="2">Tidak 12 Jam</option>
						  </select>
					</div>
					<div class="form-group">
						<?php
							$dokter=$system->db->getAll("select no_id_dokter,nama_dokter from dokter order by nama_dokter asc");
							$option='<option value="">Pilih Dokter</option>';
							foreach($dokter as $d){
								$option.='<option value="'.$d[0].'">'.$d[1].'</option>';
							}
							
						?>
						<label>Dokter</label>
						  <select name="dokter" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
					</div>
					<div class="form-group">
					  <label>Latitude</label>
					  <input type="text" name="lat"  class="form-control"  placeholder="Latitude" required>
					</div>
					<div class="form-group">
					  <label>Longitude</label>
					  <input type="text" name="lng" class="form-control"  placeholder="Longitude" required>
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
			
			if(!empty($_FILES['foto']['tmp_name'])){
				$lokasi_file=$_FILES['foto']['tmp_name'];
				$tipe_file   = $_FILES['foto']['type'];
				$gambar   = $_FILES['foto']['name'];
				//$direktori   = "../config/gambar/$gambar";
				$rename=date("dmYhis");
				$ext = strtolower(end(explode('.', $_FILES['foto']['name'])));
				$direktori   ="upload/".$rename.".".$ext;
				$new=$rename.".".$ext;
				move_uploaded_file($lokasi_file,$direktori);
			}else{
				$new=$_POST['old'];
			}
			
			
			 /* adodb_pr($_FILES);  */
			 $query="update klinik set nama_klinik='".$_POST['nama']."' ,alamat_klinik='".$_POST['alamat']."', no_telp='".$_POST['no_telp']."',foto_klinik='".$new."',deskripsi_klinik='".$_POST['desk']."',jam_operasional='".$_POST['jop']."',latitude='".$_POST['lat']."', longitude='".$_POST['lng']."', no_id_dokter='".$_POST['dokter']."' where id_klinik='".$_POST['id_klinik']."'    ";
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil Ubah');
				/*pindah gambar ke directori*/
				
				
				$_POST=array();
			}else{
				$error=alert('error','Gagal menyimpan');
			}
		}
		
		
		
		
		
		
		
		$r=$system->db->getRow("select * from klinik where id_klinik='".$_GET['id']."'");
		/* adodb_pr($r); */
	?>
	<!----- section edit apotik ------------------>
	<section class="content">
		 <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Klinik</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="nama" value="<?= $r['nama_klinik'] ?>"  placeholder="Nama Klinik" required>
					</div>
					<div class="form-group">
					  <label>Alamat</label>
					  <input type="text" name="alamat" class="form-control" value="<?= $r['alamat_klinik'] ?>"  placeholder="Alamat Apotek" required>
					</div>
					<div class="form-group">
					  <label>No Telpon</label>
					  <input type="text" name="no_telp" class="form-control" value="<?= $r['no_telp'] ?>"   placeholder="Alamat Apotek" required>
					</div>
					<div class="form-group">
					  <label>Foto</label>
					  <input type="file" name="foto" >
					  <p class="help-block">Upload Gambar.</p>
					  <img class="img-responsive" style="height:160px; width:160px; object-fit: cover;" src="upload/<?= $r['foto_klinik'] ?>" alt="Photo">
					  <input type="hidden" name="old" value="<?= $r['foto_klinik'] ?>">
					</div>
					<div class="form-group">
					  <label>Deskripsi</label>
					  <textarea class="form-control" name="desk" rows="3" placeholder="deskripsi_klinik ..."  required><?= $r['deskripsi_klinik'] ?> </textarea>
					</div>
					<div class="form-group">
						<label>Jam Operasi</label>
						  <select name="jop" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<option value="1" <?php if($r['jam_operasional']==1){echo 'selected';} ?>>24 Jam</option>
							<option value="2" <?php if($r['jam_operasional']==2){echo 'selected';} ?>>Tidak 12 Jam</option>
						  </select>
					</div>
					<div class="form-group">
						<?php
							$dokter=$system->db->getAll("select no_id_dokter,nama_dokter from dokter order by nama_dokter asc");
							$option='<option value="">Pilih Dokter</option>';
							foreach($dokter as $d){
								if($d[0]==$r['id_klinik']){
									$selected='selected';
								}else{
									$selected='';
								}
								
								$option.='<option value="'.$d[0].'" '.$selected.'>'.$d[1].'</option>';
							}
							
						?>
						<label>Dokter</label>
						  <select name="dokter" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
					</div>
					<div class="form-group">
					  <label>Latitude</label>
					  <input type="text" name="lat" value="<?= $r['latitude'] ?>"  class="form-control"  placeholder="Latitude" required>
					</div>
					<div class="form-group">
					  <label>Longitude</label>
					  <input type="text" name="lng" value="<?= $r['longitude'] ?>" class="form-control"  placeholder="Longitude" required>
					</div>
				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" name="id_klinik" value="<?= $r['id_klinik'] ?>">
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