<?php 
   session_start();
   if ($_SESSION['Id_klienta'] !== 'admin') {
       header("Location: index.php");
       exit();
   }

   include("php/config.php");

   if(isset($_POST['add_client'])){

       $email = mysqli_real_escape_string($con, $_POST['email']);
       $haslo = mysqli_real_escape_string($con, $_POST['haslo']);
       $imie = mysqli_real_escape_string($con, $_POST['imie']);
       $nazwisko = mysqli_real_escape_string($con, $_POST['nazwisko']);
       $kod_pocztowy = mysqli_real_escape_string($con, $_POST['kod_pocztowy']);
       $pesel = mysqli_real_escape_string($con, $_POST['pesel']);
       $telefon = mysqli_real_escape_string($con, $_POST['telefon']);
       $adres = mysqli_real_escape_string($con, $_POST['adres']);

       $sql = "INSERT INTO klient (email, haslo, imie, nazwisko, kod_pocztowy, pesel, telefon, adres) 
               VALUES ('$email', '$haslo', '$imie', '$nazwisko', '$kod_pocztowy', '$pesel', '$telefon', '$adres')";
       if(mysqli_query($con, $sql)){
           echo "<div class='message'><p>Dodano klienta</p></div>";
       } else {
           echo "<div class='message'><p>Błąd przy dodawaniu klienta</p></div>";
       }
   }

   if(isset($_POST['delete_client'])){
       $client_id = mysqli_real_escape_string($con, $_POST['client_id']);
       $sql = "DELETE FROM klient WHERE id_klienta='$client_id'";
       if(mysqli_query($con, $sql)){
           echo "<div class='message'><p>Usunięto klienta</p></div>";
       } else {
           echo "<div class='message'><p>Błąd przy usuwaniu klienta</p></div>";
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
    <title>Zarządzaj klientami</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Dodaj Klienta</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="haslo">Hasło</label>
                    <input type="password" name="haslo" id="haslo" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="imie">Imię</label>
                    <input type="text" name="imie" id="imie" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="nazwisko">Nazwisko</label>
                    <input type="text" name="nazwisko" id="nazwisko" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="kod_pocztowy">Kod pocztowy</label>
                    <input type="text" name="kod_pocztowy" id="kod_pocztowy" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="pesel">PESEL</label>
                    <input type="text" name="pesel" id="pesel" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="telefon">Telefon</label>
                    <input type="text" name="telefon" id="telefon" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="adres">Adres</label>
                    <input type="text" name="adres" id="adres" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="add_client" value="Dodaj Klienta">
                </div>
            </form>
            <header>Usuń Klienta</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="client_id">ID Klienta</label>
                    <input type="text" name="client_id" id="client_id" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="delete_client" value="Usuń Klienta">
                </div>
            </form>
            <a href="admin.php"><button class="btn">Wróć</button></a>
        </div>
    </div>
</body>
</html>
