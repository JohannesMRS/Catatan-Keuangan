<?php 

    require 'config/koneksi.php';


?>
<!-- Udah buat total transaksi, tinggal selisih pemasukan dan pengeluaran -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        *{
            font-family: monospace;
        }
        .judul{
            margin-top: 70px;
            margin-left: 70px;
        }

        .amount{
            width: 900px;
            height: 200px;
            margin: 0 auto;
            margin-top: 20px;
            display: flex;
            
        }

        .total-transaksi, .total-pemasukan, .total-pengeluaran, .selisih-pemasukanBesar, .selisih-pengeluaranBesar{
            background-color: white;
            width: 200px;
            height:70px;
            margin-left: 20px;
            margin-top:60px;
            font-size: 15px;
            padding-left: 20px;
            padding-top: 10px;
            font-weight: bold;
            border-radius: 7px;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 1px 1px 10px 1px rgba(0,0,0,0.2);
        }

        .total-transaksi:hover{
            background-color: rgba(238, 238, 238, 0.3);
            transform: scale3d(1.1,1.1,1.3);
            box-shadow: 1px 1px 10px 1px rgba(0,0,0,0.2)
        }
        .total-pemasukan:hover{
            background-color: rgba(188, 254, 174, 0.3);
            transform: scale3d(1.1,1.1,1.3);
            box-shadow: 1px 1px 10px 1px rgba(94, 255, 0, 0.7)
        }
        .total-pengeluaran:hover{
            background-color: rgba(255, 170, 170, 0.3);
            transform: scale3d(1.1,1.1,1.3);
            box-shadow: 1px 1px 10px 1px rgba(255, 0, 0, 0.7)
        }
        .selisih-pemasukanBesar:hover{
            background-color: rgba(188, 254, 174, 0.3);
            transform: scale3d(1.1,1.1,1.3);
            box-shadow: 1px 1px 10px 1px rgba(94, 255, 0, 0.7)
        }
        .selisih-pengeluaranBesar:hover{
            background-color: rgba(255, 170, 170, 0.3);
            transform: scale3d(1.1,1.1,1.3);
            box-shadow: 1px 1px 10px 1px rgba(255, 0, 0, 0.7)
        }

        .amount .total-pemasukan img{
            margin-left: 60px;
            width: 20px;
        }
        .amount .total-pengeluaran img{
            margin-left: 40px;
            width: 20px;
        }
        .amount .total-transaksi img{
            margin-left: 10px;
            width: 25px;
        }
        .amount .selisih-pemasukanBesar img{
            margin-left: 75px;
            width: 25px;
        }
        .amount .selisih-pengeluaranBesar img{
            margin-left: 75px;
            width: 25px;
        }

        .amount p{
            font-size: 18px;
            margin-top: 0px;
            margin-left: 5px;
        }

        .table-main{
            width: 800px;
            margin: 0 auto;
            font-size: 15px;
        }

        .filter{
            width: 200px;
            margin-bottom: 10px;
            display: flex;
        }

        .container-tambah h1{
            font-weight: bold;
            margin-left: 15px;
            margin-top: 15px;

            height: 35px;
        }

        .container-tambah h1 p{
            font-size: 25px;
        }

        .container-tambah:not(h1){
            font-size: 17px;
        }

    </style>
</head>
<body>
    <h1 style="font-weight: bold;" class = "judul">Personal Finance Tracker</h1>
    


<!-- Data Total -->
<div class = "amount">
    <?php $queryTotalTransaksi = mysqli_query($conn, "SELECT * FROM keuangan"); ?>
    <?php $totalTransaksi = mysqli_num_rows($queryTotalTransaksi); ?>
    <div class="total-transaksi">
        Total Transaksi
        <img src="img/transaction.png" alt="">
        <p><?php echo $totalTransaksi; ?></p>
    </div>
    <?php $queryTotalPemasukan = mysqli_query($conn, "SELECT SUM(CAST(total AS INT)) AS total_harga FROM keuangan WHERE jenis = 'Pemasukan'"); ?>
    <?php $totalPemasukan = mysqli_fetch_assoc($queryTotalPemasukan);?>
    <div class="total-pemasukan">
        Pemasukan
        <img src="img/up.png" alt="">
        <p style="color: #00ff15;"><?php echo "Rp" . number_format($totalPemasukan['total_harga']);?></p>
    </div>
    
    <?php $queryTotalPengeluaran = mysqli_query($conn, "SELECT SUM(CAST(total AS INT)) AS total_harga FROM keuangan WHERE jenis = 'Pengeluaran'"); ?>
    <?php $totalPengeluaran = mysqli_fetch_assoc($queryTotalPengeluaran); ?>
    <div class="total-pengeluaran">
        Pengeluaran
        <img src="img/down.png" alt="">
        <p style="color: #ff1100;"><?php echo "Rp".number_format($totalPengeluaran['total_harga']); ?></p>
    </div>
    

    <?php if($totalPemasukan['total_harga'] > $totalPengeluaran['total_harga']): ?>
    <?php  $querySelisih = $totalPemasukan['total_harga'] - $totalPengeluaran['total_harga'];?>
        <div class="selisih-pemasukanBesar">
            Selisih
            <img src="img/nfc.png" alt="">
            <p style="color: #00ff15;"><?php echo "Rp".number_format($querySelisih); ?></p>
        </div>
    <?php  else:?>
    <?php  $querySelisih = $totalPengeluaran['total_harga'] - $totalPemasukan['total_harga'];?>
        <div class="selisih-pengeluaranBesar">
            Selisih
            <img src="img/nfc.png" alt="">
            <p style="color: #ff1100;"><?php echo "Rp".number_format($querySelisih); ?></p>
        </div>
    <?php endif; ?>

</div>
<!-- Data Total -->



<!-- Tabel data -->
<div class="table-main">
    <div class="filter">
        <select class="form-select" aria-label="Default select example">
            <option selected>Filter</option>
            <option value="1">Pemasukan</option>
            <option value="2">Pengeluaran</option>
        </select>
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalTambah" style="margin-left: 20px;">Tambah</button>
    </div>
    
    
    
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th scope="col" style="text-align: center;">No</th>
                <th scope="col" style="text-align: center;">Tanggal</th>
                <th scope="col" style="text-align: center;">Jumlah</th>
                <th scope="col" style="text-align: center;">Jenis</th>
                <th scope="col" style="text-align: center;" class = "w-25">Deskripsi</th>
                <th scope="col" style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php 
                $batas = 3;
                $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                $awal = ($halaman * $batas) - $batas;

                $data = mysqli_query($conn, "SELECT * FROM keuangan");
                $banyakData = mysqli_num_rows($data);
                $banyakHalaman = ceil($banyakData / $batas);

                $queryLimit = mysqli_query($conn, "SELECT * FROM keuangan LIMIT $awal, $batas ");
                $no = $awal + 1;
                while($row = mysqli_fetch_assoc($queryLimit)): ?>
                <tr>
                    <th scope="row" style="text-align: center; width: 40px;"><?php echo $no++; ?></th>
                    <td style="text-align: center; width: 120px;"><?php echo $row['tanggal']; ?></td>
                    <td style="width: 100px;"><?php echo "Rp. ".number_format($row['total']); ?></td>
                    <?php if($row['jenis'] == "Pemasukan"): ?>
                        <td style="text-align: center; width: 100px;"><p style="background-color: #2fff00; border-radius: 5px; width: 90px; color: white;"><?php echo $row['jenis']; ?></p></td>
                    <?php else: ?>
                        <td style="text-align: center; width: 100px;"><p style="background-color: #ff9900; border-radius: 5px; color: white; width: 100px;"><?php echo $row['jenis']; ?></p></td>
                    <?php endif; ?>
                    <td class = "w-25"><?php echo $row['deskripsi']; ?></td>
                    <td style="text-align: center; width: 120px;">
                        <a href="proses/hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin dek?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $no; ?>">Edit</button>
                    </td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>
    <?php for($i = 1; $i <= $banyakHalaman; $i++): ?>
    <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>
<!-- Tabel data -->

<!-- Pagination -->



<!-- Pagination -->

            
            
<!-- Form tambah data -->
<div class="container-tambah">
    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><p>Tambah Data Keuangan</p></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -40px;"></button>
            </div>
            <div class="modal-body">
                <form action="proses/tambah.php" method="POST">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" inputmode="numeric" class="form-control" name="jumlah" id="jumlah"  placeholder="masukkan nominal, ex: 10000">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="jenis" id="jenis">
                            <option selected>Pilih Jenis</option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="masukkan penjelasan transaksi max 100 karakter">
                    </div>
                    
                
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
<!-- Form tambah data -->




<!-- Form Edit -->

<?php $querySelectEdit = mysqli_query($conn, "SELECT * FROM keuangan "); ?>
<?php $no=1; ?>
<?php  while($row = mysqli_fetch_assoc($querySelectEdit)): ?>
    <?php $no++; ?>
<div class="container-edit">
    <!-- Modal -->
    <div class="modal fade" id="modalEdit<?php echo $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><p>Edit Data Keuangan</p></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-top: -40px;"></button>
            </div>
            <div class="modal-body">
                <form action="proses/editAksi.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo $row['tanggal']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?php echo $row['total']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="jenis" id="jenis">
                            <option selected <?php echo $row['jenis']; ?>><?php echo $row['jenis']; ?></option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?php echo $row['deskripsi']; ?>">
                    </div>
                    
                
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
    
</div>

<?php endwhile; ?>
<!-- Form Edit -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>