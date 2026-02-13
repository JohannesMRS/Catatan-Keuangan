<?php 
    require 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #4cc9f0;
            --accent: #34d399;
            --dark: #0f172a;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            text-align: center;
            max-width: 600px;
            width: 90%;
            transition: transform 0.3s ease;
        }

        .hero-card:hover {
            transform: translateY(-5px);
        }

        .judul {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            color: var(--dark);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .judul span {
            background: linear-gradient(90deg, var(--accent), #024027);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .judul2 {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            font-weight: 400;
        }

        .btn-modern {
            background: #08e58d;
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
        }

        .btn-modern:hover {
            background: #00965a;
            transform: scale(1.05);
            box-shadow: 0 15px 25px rgba(67, 97, 238, 0.4);
            color: white;
        }

        /* Decorative Elements */
        .circle {
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            filter: blur(80px);
        }
        .circle-1 {
            width: 300px;
            height: 300px;
            background: rgba(67, 97, 238, 0.15);
            top: -50px;
            left: -50px;
        }
        .circle-2 {
            width: 250px;
            height: 250px;
            background: rgba(52, 211, 153, 0.15);
            bottom: -50px;
            right: -100px;
        }
    </style>
</head>
<body>
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="hero-card">
        <h1 class="judul"><span>Kelola Finansial</span> Jadi Lebih Mudah</h1>
        <p class="judul2">Pantau setiap pengeluaran dan pemasukanmu dengan presisi. Saatnya kendalikan masa depan finansialmu sekarang.</p>

        <a href="keuangan.php" class="btn-modern">Mulai Pantau</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>