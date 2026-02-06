<?php 
    require '../config/koneksi.php';
    $id = $_GET['id'];

    $queryHapus = mysqli_query($conn, "DELETE FROM keuangan WHERE id = $id");
    header("location:../keuangan.php");
?>