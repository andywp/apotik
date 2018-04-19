<?php include'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Layanan
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
			
			
			/* adodb_pr($_POST);  */
			 $query="insert into layanan set nama_layanan='".$_POST['nama']."' ,id_klinik='".$_POST['klinik']."', id_apotek='".$_POST['apotek']."'    ";
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil ditambah');
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
              <h3 class="box-title">Tambah Data Layanan</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama Layanan</label>
					  <input type="text" class="form-control" name="nama"  placeholder="Nama Layanan" required>
					</div>
					<div class="form-group">
						<?php
							$klinik=$system->db->getAll("select id_klinik,nama_klinik from klinik order by nama_klinik asc");
							$option='<option value="">Pilih Klinik</option>';
							foreach($klinik as $d){
								$option.='<option value="'.$d[0].'">'.$d[1].'</option>';
							}
							
						?>
						<label>Klinik</label>
						  <select name="klinik" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
					</div>
					<div class="form-group">
						<?php
							$apotek=$system->db->getAll("select id_apotek,nama_apotek from apotek order by nama_apotek asc");
							$option='<option value="">Pilih Apotek</option>';
							foreach($apotek as $d){
								$option.='<option value="'.$d[0].'">'.$d[1].'</option>';
							}
							
						?>
						<label>Apotek</label>
						  <select name="apotek" class="form-control select2" style="width: 100%;"  required>	
							
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
			  $query="update layanan set nama_layanan='".$_POST['nama']."' ,id_klinik='".$_POST['klinik']."', id_apotek='".$_POST['apotek']."' where id_layanan='".$_POST['id_layanan']."'   ";
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil Ubah');
				/*pindah gambar ke directori*/
				
				
				$_POST=array();
			}else{
				$error=alert('error','Gagal menyimpan');
			}
		}
		
		
		
		
		
		
		
		$r=$system->db->getRow("select * from layanan where id_layanan='".$_GET['id']."'");
		 /* adodb_pr($r);  */
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
					  <label>Nama Layanan</label>
					  <input type="text" class="form-control" name="nama" value="<?= $r['nama_layanan'] ?>"  placeholder="Nama Layanan" required>
					</div>
					<div class="form-group">
						<?php
							$klinik=$system->db->getAll("select id_klinik,nama_klinik from klinik order by nama_klinik asc");
							$option='<option value="">Pilih Klinik</option>';
							foreach($klinik as $d){
								if($r['id_klinik'] == $d[0]){
									$selected="selected";
								}else{
									$selected="";
								}
								
								$option.='<option value="'.$d[0].'" '.$selected.' >'.$d[1].'</option>';
							}
							
						?>
						<label>Klinik</label>
						  <select name="klinik" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
					</div>
					<div class="form-group">
						<?php
							$apotek=$system->db->getAll("select id_apotek,nama_apotek from apotek order by nama_apotek asc");
							$option='<option value="">Pilih Apotek</option>';
							foreach($apotek as $d){
								if($r['id_apotek'] == $d[0]){
									$selected="selected";
								}else{
									$selected="";
								}
								$option.='<option value="'.$d[0].'" '.$selected.' >'.$d[1].'</option>';
							}
							
						?>
						<label>Apotek</label>
						  <select name="apotek" class="form-control select2" style="width: 100%;"  required>	
							
							<?= $option ?>
						  </select>
					</div>
				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" name="id_layanan" value="<?= $r['id_layanan'] ?>">
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