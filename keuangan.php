<?php require 'config/koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .pemasukan{
            background-color: #89f7b9;
            width:85px;
            padding: 4px;
            border-radius:4px ;
        }
        .pengeluaran{
            background-color: #ed9999;
            width:90px;
            padding: 4px;
            border-radius:4px ;
        }
        #hapus, #edit{
            transition: all .3s ease;
        }
        #hapus{
            margin-left: 10px;
        }

        #hapus:hover{
            background-color: #efe1e1;
        }

        #edit:hover{
            background-color: #e2e9ee;
        }

        #btn-tambah{
            transition: all .3s ease;
        }

        #btn-tambah:hover{
            background-color: #364fc0;
            transform: translateY(-3px);
        }
        

        
    </style>
</head>
<body>

<div class="header-section">
    <h1 class="judul">Finance Dashboard</h1>
</div>

<div class="amount-container">
    <?php 
    $totalTransaksi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keuangan")); 
    $resIn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) as total FROM keuangan WHERE jenis='Pemasukan'"));
    $resOut = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) as total FROM keuangan WHERE jenis='Pengeluaran'"));
    
    $in = $resIn['total'] ?? 0;
    $out = $resOut['total'] ?? 0;
    $selisih = abs($in - $out);
    $warnaSelisih = ($in >= $out) ? 'var(--success)' : 'var(--danger)';
    ?>

    <div class="stat-card">
        <span class="stat-label">Total Transaksi</span>
        <div class="stat-value"><?= $totalTransaksi ?></div>
    </div>

    <div class="stat-card">
        <span class="stat-label">Total Pemasukan</span>
        <div class="stat-value" style="color: var(--success)">Rp <?= number_format($in) ?></div>
    </div>

    <div class="stat-card">
        <span class="stat-label">Total Pengeluaran</span>
        <div class="stat-value" style="color: var(--danger)">Rp <?= number_format($out) ?></div>
    </div>

    <div class="stat-card">
        <span class="stat-label">Saldo Saat Ini</span>
        <div class="stat-value" style="color: <?= $warnaSelisih ?>">Rp <?= number_format($selisih) ?></div>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h2 style="font-size: 18px;">Riwayat Transaksi</h2>
        <button class="btn-tambah" id="btn-tambah" >+ Tambah Data</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Pagination logic tetap sama
            $batas = 5;
            $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
            $awal = ($halaman * $batas) - $batas;
            $queryLimit = mysqli_query($conn, "SELECT * FROM keuangan LIMIT $awal, $batas");
            $no = $awal + 1;
            
            while($row = mysqli_fetch_assoc($queryLimit)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                <td style="font-weight: 600;">Rp <?= number_format($row['total']) ?></td>
                <?php if($row['jenis']  == 'Pemasukan'): ?>
                <td>
                    <p class = "pemasukan"><?php echo $row['jenis'] ?></p>
                </td>
                <?php else: ?>
                <td>
                    <p  class = "pengeluaran"><?php echo $row['jenis'] ?></p>
                </td>
                <?php endif; ?>
                <td style="color: var(--text-light); width: 260px;"><?= $row['deskripsi'] ?></td>
                <td>
                    <a href="proses/editAksi.php?id=<?= $row['id']; ?>" class="btn-action btn-edit" id="edit">Edit</a>
                    <a href="proses/hapus.php?id=<?= $row['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Hapus data ini?')" id="hapus">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination">
        </div>
</div>

</body>
</html>