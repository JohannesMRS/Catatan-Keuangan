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
    </style>
</head>
<body>
    <div class="modal-overlay" id="modalTambah">
    <div class="modal-content">
        <h2 style="margin-bottom: 24px; font-size: 20px;">Tambah Transaksi</h2>
        
        <form action="proses/tambah.php" method="POST">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label>Nominal (Rp)</label>
                <input type="number" name="jumlah" class="form-input" placeholder="Contoh: 50000" required>
            </div>
            
            <div class="form-group">
                <label>Jenis Transaksi</label>
                <select name="jenis" class="form-input" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-input" rows="3" placeholder="Makan siang, Gaji bulanan, dll"></textarea>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" name="submit" class="btn-tambah">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

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
        <button class="btn-tambah" >+ Tambah Data</button>
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
                <td style="color: var(--text-light);"><?= $row['deskripsi'] ?></td>
                <td>
                    <a href="proses/editAksi.php?id=<?= $row['id']; ?>" class="btn-action btn-edit">Edit</a>
                    <a href="proses/hapus.php?id=<?= $row['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Hapus data ini?')">Hapus</a>
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