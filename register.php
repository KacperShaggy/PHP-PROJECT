<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         
         include("php/config.php");
         if(isset($_POST['submit'])){
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $kod_pocztowy = $_POST['kod_pocztowy'];
            $adres = $_POST['adres'];
            $telefon = $_POST['telefon'];
            $pesel = $_POST['pesel'];
            $email = $_POST['email'];
            $haslo = $_POST['haslo'];

         //verifying the unique email

         $verify_query = mysqli_query($con,"SELECT email FROM klient WHERE email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>Tej email jest już użyty! Użyj innego!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Wróć!</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO klient VALUES(NULL, '$nazwisko','$imie','$kod_pocztowy','$pesel','$telefon','$email','$adres', '$haslo')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Zarejetrsowano pomyślnie!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Zaloguj się!</button>";
         

         }

         }else{
         
        ?>

            <header>Zarejestruj sie!</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Imie">Imie</label>
                    <input type="text" name="imie" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Nazwisko">Nazwisko</label>
                    <input type="text" name="nazwisko" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="kod_pocztowy">Kod pocztowy</label>
                    <input type="text" name="kod_pocztowy" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="miejscowosc">Adres</label>
                    <input type="text" name="adres" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="pesel">Telefon</label>
                    <input type="text" name="telefon" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="pesel">Pesel</label>
                    <input type="text" name="pesel" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="haslo">Hasło</label>
                    <input type="password" name="haslo" id="haslo" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Zarejestruj sie!" required>
                </div>
                <div class="links">
                    Masz już konto? <a href="index.php">Zaloguj się!</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>