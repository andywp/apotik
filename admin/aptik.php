<?php include'header.php'; 
$error='';
/**************************************************/
/*************** Hapus apotik *********************/
/**************************************************/
if(@$_GET['act']=='hapus' && @$_GET['id'] != 0){
	
	$query="delete from apotek where id_apotek='".$_GET['id']."'";
	$hapus=$system->db->execute($query);
	if($hapus){
		$error=alert('success','Data berhasil dihapus');
	}else{
		$error=alert('error','Gagal menghapus data');
	}	
}






$per_hal=10;
$jum=$system->db->getOne("select count(*) from apotek ");
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;	
$data=$system->db->getAll("select * from apotek where 1 limit ".$start.",".$per_hal);
$tabel='';
$no=1;
foreach($data as $r){
	$tabel.='<tr>
				<td>'.$no.'</td>
				<td>'.$r['nama_apotek'].'</td>
				<td>'.$r['alamat_apotek'].'</td>
				<td>'.$r['no_telp'].'</td>
				<td>'.$r['latitude'].'</td>
				<td>'.$r['longitude'].'</td>
				<td><a href="form_apotik.php?page=edit&id='.$r['id_apotek'].'" class="btn btn-block btn-success"><i class="fa fa-edit"></i></a></td>
				<td><a href="aptik.php?act=hapus&id='.$r['id_apotek'].'" onclick="return confirm (\'hapus data....?\')  " class="btn btn-block btn-danger"><i class="fa fa-trash-o"></i></a></td>
			</tr>
				';
				
	$no++;
}


/* peging */
$page='';
for($x=1;$x<=$halaman;$x++){
	$page.='<li><a href="?page='.$x.'">'.$x.'</a></li>';
}
$peging='';
if(!empty($page) && $halaman !=1 ){
	
	$peging='<ul class="pagination pagination-sm no-margin pull-right">
				'.$page.'
			</ul>
			';
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Apotek 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Apotik</h3>
			  <div class="box-tools">
                <a href="form_apotik.php" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th colspan="2" >Ation</th>
                </tr>
                <?= $tabel ?>
				</tbody>
			  </table>
            </div>
            <!-- /.box-body -->
			<div class="box-footer clearfix">
				<?= $peging ?>
			</div>
          </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'footer.php'; ?>