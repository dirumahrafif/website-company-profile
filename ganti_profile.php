<?php include("inc_header.php")?>
<?php 
if(isset($_SESSION['members_email']) == ''){ //belum dalam keadaan login
    header("location:login.php");
    exit();
}
?>
<h3>Ganti Profile Akun</h3>
<?php 
$email          = "";
$nama_lengkap   = "";
$err            = "";
$sukses         = "";

if(isset($_POST['simpan'])){
    $nama_lengkap           = $_POST['nama_lengkap'];
    $password_lama          = $_POST['password_lama'];
    $password               = $_POST['password'];
    $konfirmasi_password    = $_POST['konfirmasi_password'];

    if($nama_lengkap == ''){
        $err .= "<li>Silakan masukkan nama lengkap</li>";
    }

    if($password != ''){ //jika akan melakukan perubahan password
        $sql1 = "select * from members where email = '".$_SESSION['members_email']."'";
        $q1   = mysqli_query($koneksi,$sql1);
        $r1   = mysqli_fetch_array($q1);
        if(md5($password_lama) != $r1['password']){
            $err .= "<li>Password yang kamu tuliskan tidak sesuai dengan password sebelumnya</li>";
        }

        if($password_lama == '' or $konfirmasi_password == '' or $password == ''){
            $err .= "<li>Silakan masukkan password lama, password baru serta konfirmasi password</li>";
        }

        if($password != $konfirmasi_password){
            $err .= "<li>Silakan masukkan password dan konfirmasi password yang sama</li>";
        }

        if(strlen($password) < 6){
            $err .= "<li>Panjang karakter yang diizininkan untuk password adalah 6 karakter, minimal.</li>";
        }
    }

    if(empty($err)){
        $sql1 = "update members set nama_lengkap = '".$nama_lengkap."' where email = '".$_SESSION['members_email']."'";
        mysqli_query($koneksi,$sql1);
        $_SESSION['members_nama_lengkap'] = $nama_lengkap;

        if($password){
            $sql2 = "update members set password = md5($password) where email = '".$_SESSION['members_email']."'";
            mysqli_query($koneksi,$sql2);
        }

        $sukses = "Data berhasil diubah";
    }

}
?>
<?php if($err) {echo "<div class='error'><ul>$err</ul></div>";} ?>
<?php if($sukses) {echo "<div class='sukses'>$sukses</div>";} ?>

<form action="" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td>
                <?php echo $_SESSION['members_email']?>
            </td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>
                <input type="text" name="nama_lengkap" class="input" value="<?php echo $_SESSION['members_nama_lengkap']?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Password Lama</td>
            <td>
                <input type="password" name="password_lama" class="input" />
            </td>
        </tr>
        <tr>
            <td class="label">Password Baru</td>
            <td>
                <input type="password" name="password" class="input" />
            </td>
        </tr>
        <tr>
            <td class="label">Konfirmasi Password</td>
            <td>
                <input type="password" name="konfirmasi_password" class="input" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="simpan" value="simpan" class="tbl-biru"/>
            </td>
        </tr>
    </table>
</form>

<?php include("inc_footer.php")?>