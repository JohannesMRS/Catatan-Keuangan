<?php 
    require '../config/koneksi.php';
if(isset($_POST['submit'])){
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];
    $deskripsi = $_POST['deskripsi'];

    $queryTambah = mysqli_query($conn, "INSERT INTO keuangan VALUES ('', '$tanggal', '$jumlah', '$jenis', '$deskripsi')");


    if(!$queryTambah){
        die("error ". mysqli_error($conn));
    }
    header("location: ../keuangan.php");
}
?>