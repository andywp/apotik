<?php
session_start();
if(!isset($_SESSION['id_pegawai'])){
die("<div align='center'>
<script>alert('Maaf silahakan Login Dahulu untuk masuk ke halaman Admin')</script>
<html><head><meta http-equiv='refresh' content='0;url=index.php'></head><body></body></html>
</div>");

}
?>
