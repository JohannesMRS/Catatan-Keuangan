<?php 
    require 'config/koneksi.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Tracker</title>
    <link rel="icon" type="image" href="img/favicon/favicon.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        *{
            font-family: monospace;
        }
        .container-main{
            background-color: #f0f0f0;
            height: 702px;
        }

        .judul{
            text-align: center;
            padding-top: 201px;
            font-weight: bold;
        }

        .judul2{
            text-align: center;
            padding-top: 40px;
        }

        .button-klik{
            text-align: center;
            margin-top: 40px;
            transition: all .3s ease;
            background-color: red;
            width: 120px;
            margin: 0 auto;
            margin-top: 40px;
            border-radius: 5px;
        }

        button{
            width: 120px;
            height: 50px;

        }

        button a{
            font-size: 18px;
            color: white;
            text-decoration: none;
        }

        .button-klik:hover{
            transform: scale(1.1);
        }
    </style>

    
</head>
<body>
    <div class = "container-main">
    <h1 class="judul">Selamat Datang Di Personal Finance Tracker</h1>
    <h2 class="judul2">Mari Lihat Keuanganku</h2>

    <div class="button-klik">
        <button type="button" class="btn btn-primary"><a href="keuangan.php">Let's Go</a></button>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>