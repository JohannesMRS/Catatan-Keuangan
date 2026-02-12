<?php 
    require '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .emerald-gradient { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .input-focus:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); outline: none; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all">
        <div class="emerald-gradient p-8 text-white">
            <h2 class="text-2xl font-bold">Edit Transaksi</h2>
            <p class="text-emerald-50 opacity-90 text-sm mt-1">Perbarui data keuangan Anda dengan teliti.</p>
        </div>
        <?php $id = $_GET['id']; ?>
        <?php $querySelect = mysqli_query($conn, "SELECT * FROM keuangan WHERE id = $id"); ?>
        <?php while ($row = mysqli_fetch_assoc($querySelect)): ?>
        <form action="update_data.php" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-600 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="<?= $row['tanggal']; ?>" 
                           class="border border-gray-200 p-3 rounded-xl input-focus text-gray-700 transition-all">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold text-gray-600 mb-2">Jenis</label>
                    <select name="jenis" class="border border-gray-200 p-3 rounded-xl input-focus text-gray-700 transition-all">
                        <option value="Pemasukan" <?= $row['jenis'] == 'Pemasukan' ? 'selected' : ''; ?>>Pemasukan</option>
                        <option value="Pengeluaran" <?= $row['jenis'] == 'Pengeluaran' ? 'selected' : ''; ?>>Pengeluaran</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col">
                <label class="text-sm font-semibold text-gray-600 mb-2">Jumlah (Rp)</label>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400 font-medium">Rp</span>
                    <input type="number" name="jumlah"  
                           class="w-full border border-gray-200 p-3 pl-12 rounded-xl input-focus text-gray-700 font-medium transition-all" 
                           placeholder="0" value="<?= $row['total']; ?>">
                </div>
            </div>

            <div class="flex flex-col">
                <label class="text-sm font-semibold text-gray-600 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" 
                          class="border border-gray-200 p-3 rounded-xl input-focus text-gray-700 transition-all" 
                          placeholder="Tambahkan catatan..."><?= $row['deskripsi']; ?></textarea>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" 
                        class="flex-1 emerald-gradient text-white font-bold py-3 px-6 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-emerald-200 active:scale-[0.98]">
                    Simpan Perubahan
                </button>
                <a href="../keuangan.php" 
                   class="px-6 py-3 bg-gray-100 text-gray-500 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    Batal
                </a>
            </div>
        </form>
        <?php endwhile; ?>
    </div>

</body>
</html>