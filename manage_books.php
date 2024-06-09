<?php 
   session_start();
   if ($_SESSION['Id_klienta'] !== 'admin') {
       header("Location: index.php");
       exit();
   }

   include("php/config.php");

   if(isset($_POST['add_book'])){

       $tytul = mysqli_real_escape_string($con, $_POST['tytul']);
       $autor = mysqli_real_escape_string($con, $_POST['autor']);
       $cena = mysqli_real_escape_string($con, $_POST['cena']);
       $ilosc = intval($_POST['ilosc']);

       $sql = "INSERT INTO ksiazki (tytul, autor, cena, ilosc) 
               VALUES ('$tytul', '$autor', '$cena', '$ilosc')";
       if(mysqli_query($con, $sql)){
           echo "<div class='message'><p>Dodano książkę</p></div>";
       } else {
           echo "<div class='message'><p>Błąd przy dodawaniu książki: " . mysqli_error($con) . "</p></div>";
       }
   }

   if(isset($_POST['delete_book'])){

       $book_id = mysqli_real_escape_string($con, $_POST['book_id']);
       $sql = "DELETE FROM ksiazki WHERE id_ksiazki='$book_id'";
       if(mysqli_query($con, $sql)){
           echo "<div class='message'><p>Usunięto książkę</p></div>";
       } else {
           echo "<div class='message'><p>Błąd przy usuwaniu książki: " . mysqli_error($con) . "</p></div>";
       }
   }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Zarządzaj książkami</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Dodaj Książkę</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="tytul">Tytuł</label>
                    <input type="text" name="tytul" id="tytul" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="cena">Cena</label>
                    <input type="text" name="cena" id="cena" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="ilosc">Ilość egzemplarzy</label>
                    <input type="number" name="ilosc" id="ilosc" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="add_book" value="Dodaj Książkę">
                </div>
            </form>
            <header>Usuń Książkę</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="book_id">ID Książki</label>
                    <input type="text" name="book_id" id="book_id" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="delete_book" value="Usuń Książkę">
                </div>
            </form>
            <a href="admin.php"><button class="btn">Wróć</button></a>
        </div>
    </div>
</body>
</html>
