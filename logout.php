<?php
session_start();
unset($_SESSION['members_email']);
unset($_SESSION['members_nama_lengkap']);
session_destroy();
header("location:index.php");
?>