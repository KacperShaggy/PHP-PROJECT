<?php 
   session_start();
   if ($_SESSION['Id_klienta'] !== 'admin') {
       header("Location: index.php");
       exit();
   }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Admin Panel</title>
</head>
<body>
    <span class="napis">WITAJ W PANELU ADMINISTRACYJNYM!</span>
    <div class="container">
        <div class="box form-box">
            <header>Wybierz operację do wykonania:</header>
            <div class="admin-options">
                <a href="manage_clients.php"><button class="btn">Usuń/Dodaj klienta</button></a>
                <a href="manage_books.php"><button class="btn">Usuń/Dodaj książkę</button></a>
                <a href="index.php"><button class="btn">Wyloguj się</button></a>
            </div>
        </div>
    </div>
</body>
</html>
