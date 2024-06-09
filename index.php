<?php
session_start();
include("php/config.php");

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $haslo = trim($_POST['haslo']);

        if ($email === "admin" && $haslo === "12345") {
            // Admin login
            $_SESSION['Id_klienta'] = "admin";
            $_SESSION['valid'] = $email;
            $_SESSION['imie'] = "Admin";
            $_SESSION['nazwisko'] = "";
            $_SESSION['kod_pocztowy'] = "";
            $_SESSION['pesel'] = "";
            $_SESSION['telefon'] = "";
            $_SESSION['haslo'] = $haslo;
            $_SESSION['adres'] = "";

            header("Location: admin.php");
            exit();
        } else {
            // Client login
            $stmt = $con->prepare("SELECT * FROM klient WHERE email = ? AND haslo = ?");
            $stmt->bind_param("ss", $email, $haslo);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                // Store session data
                $_SESSION['id_klienta'] = $row['id_klienta'];
                $_SESSION['valid'] = $row['email'];
                $_SESSION['imie'] = $row['imie'];
                $_SESSION['nazwisko'] = $row['nazwisko'];
                $_SESSION['kod_pocztowy'] = $row['kod_pocztowy'];
                $_SESSION['pesel'] = $row['pesel'];
                $_SESSION['telefon'] = $row['telefon'];
                $_SESSION['haslo'] = $row['haslo'];
                $_SESSION['adres'] = $row['adres'];


                header("Location: home.php");
                exit();
            } else {
                $error_message = "Nieprawidłowy email lub hasło.";
            }
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
    <title>Login</title>
</head>

<body>
    <span class="napis">WITAJ W KSIĘGARNI INTERNETOWEJ!</span>
    <div class="container">
        <div class="box form-box">
            <?php if (isset($error_message)): ?>
                <div class="message">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
                <br>
                <a href="index.php"><button class="btn">Wróć!</button></a>
            <?php else: ?>
                <header>Zaloguj się, aby przejść dalej!</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="haslo">Hasło</label>
                        <input type="password" name="haslo" id="haslo" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Zaloguj się">
                    </div>
                    <div class="links">
                        Nie masz jeszcze konta? <a href="register.php">Zarejestruj się!</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>