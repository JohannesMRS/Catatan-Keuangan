<?php 
    $connUser = mysqli_connect('localhost', 'root', '', 'mahasiswa');
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $querySelect = mysqli_query($connUser, "SELECT * FROM users WHERE username = '$username' and password = '$password'");
        $checkData = mysqli_num_rows($querySelect);
        if($checkData == 1){
            echo "<script>
                alert('Login Berhasil')
                document.location.href = '../index.php'
            </script>";
        }else{
            echo "<script>
                alert('Login Gagal')
                document.location.href = 'login.php'
            </script>";
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: monospace;
        }
        body{
            background-image: linear-gradient(to right, rgb(0, 255, 157), rgb(0, 255, 0));
        }
        .container-main{
            background-color: white;
            width: 400px;
            height: 450px;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            box-shadow: 1px 1px 10px 1px rgba(0,0,0,0.7);
            margin-top: 150px;
            border-radius: 10px;
        }

        .judul-form{
            font-size: 30px;
        }

        .username, .password{
            margin-top: 20px;
            height: 40px;
            width: 250px;
            font-size: 18px;
        }

        .username, .password{
            padding-left: 10px;
            transition: all .2s ease;
            border: 1px solid rgb(13, 255, 0);
        }

        .password{
            margin-bottom: 40px;
        }

        .username::placeholder, .password::placeholder{
            font-size: 18px;
        }

        .username:focus, .password:focus{
            border: none;
            outline: none;
            box-shadow: 1px 1px 20px 1px rgba(0, 255, 0, 0.5);
        }

        .submit-login{
            width: 260px;
            height: 40px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            background-color: rgba(0, 255, 0, 0.5);
            border: none;
            transition: all .3s ease;
        }

        .submit-login:hover{
            background-color: rgba(0, 108, 0, 0.5);
        }

        .belum-daftar a{
            color: rgba(1, 186, 1, 0.5) ;
            transition: all .2s ease in;
        }

        .belum-daftar a:hover{
            color: rgba(0, 108, 0, 0.5);
        }




    </style>
</head>
<body>
    <form action="" method="POST" class="container-main">
        <h1 class="judul-form">Form Login</h1>
        <input type="text" name="username" placeholder="Username" class="username">
        <br>
        <input type="password" name="password" placeholder="password" class="password">
        <br>
        <button type="submit" name="submit" class="submit-login">submit</button>
        <p class="belum-daftar">Belum Punya Akun? <a href="register.php">daftar disini</a></p>
    </form>
</body>
</html>