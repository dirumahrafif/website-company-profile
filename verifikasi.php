<?php include("inc_header.php")?>
<?php 
$err     = "";
$sukses  = "";

if(!isset($_GET['email']) or !isset($_GET['kode'])){
    $err    = "Data yang diperlukan untuk verifikasi tidak tersedia.";
}else{
    $email  = $_GET['email'];
    $kode   = $_GET['kode'];

    $sql1   = "select * from members where email = '$email'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    if($r1['status'] == $kode){
        $sql2   = "update members set status = '1' where email = '$email'";
        mysqli_query($koneksi,$sql2);
        $sukses = "Akun telah aktif. Silakan login di halaman login.";
    }else{
        $err = "Kode tidak valid";
    }
}
?>
<h3>Halaman Verifikasi</h3>
<?php if($err) { echo "<div class='error'>$err</div>";}?>
<?php if($sukses) { echo "<div class='sukses'>$sukses</div>";}?>
<?php include("inc_footer.php")?>