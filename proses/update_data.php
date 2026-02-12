<?php 

    require '../config/koneksi.php';
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];
    $deskripsi = $_POST['deskripsi'];
    $id = $_POST['id'];

    mysqli_query($conn, "UPDATE keuangan SET tanggal = '$tanggal', total = '$jumlah', jenis = '$jenis', deskripsi = '$deskripsi' WHERE id = $id");
    header("location: ../keuangan.php");
?>