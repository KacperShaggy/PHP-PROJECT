<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

include("php/config.php");

$query = "SELECT * FROM ksiazki WHERE ilosc > 0";
$result = mysqli_query($con, $query) or die("Błąd zapytania o książki");


if (isset($_POST['order'])) {
    if (isset($_POST['liczba_egzemplarzy']) && is_numeric($_POST['liczba_egzemplarzy'])) {
        $id_klienta = $_SESSION['id_klienta'];
        $id_ksiazki = intval($_POST['id_ksiazki']);
        $liczba_egzemplarzy = intval($_POST['liczba_egzemplarzy']);

        $update_stmt = $con->prepare("UPDATE ksiazki SET ilosc = ilosc - ? WHERE id_ksiazki = ?");
        $update_stmt->bind_param("ii", $liczba_egzemplarzy, $id_ksiazki);
        $update_result = $update_stmt->execute();

        if ($update_result) {
            $current_time = date('Y-m-d H:i:s');
            $insert_stmt = $con->prepare("INSERT INTO zamowienia (id_klienta, id_ksiazki, data_zamowienia) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("iis", $id_klienta, $id_ksiazki, $current_time);
            $insert_result = $insert_stmt->execute();

            if ($insert_result) {
                $book_stmt = $con->prepare("SELECT * FROM ksiazki WHERE id_ksiazki = ?");
                $book_stmt->bind_param("i", $id_ksiazki);
                $book_stmt->execute();
                $book_result = $book_stmt->get_result();
                $book_row = $book_result->fetch_assoc();

                $cena = $book_row['cena'] * $liczba_egzemplarzy;
                echo "<p class='info'>Zamówiono: " . htmlspecialchars($book_row['tytul']) . ", Cena: $cena</p>";
            } else {
                echo "Błąd podczas dodawania zamówienia.";
            }
        } else {
            echo "Błąd podczas aktualizacji ilości dostępnych książek.";
        }
    } else {
        echo "Nie podano liczby egzemplarzy.";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
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
    <title>Zamów książki</title>
</head>
<body>
    <div class="container">
        <div class="box">       
        <form action="" method="post">
            <input type="submit" name="logout" value="Wyloguj się">
        </form>
        <h2>Zamów książki:</h2>
        <form action="" method="post">
            Wybierz książkę: 
            <select name="id_ksiazki">
                <option value="" disabled selected>Wybierz książkę</option>
                <?php
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . htmlspecialchars($row['id_ksiazki']) . "'>" . htmlspecialchars($row['tytul']) . "</option>";
                    }
                ?>
            </select>
            <br>Podaj liczbę egzemplarzy: 
            <input type="number" name="liczba_egzemplarzy" min="1"><br>
            <input type="submit" name="order" value="Zamów">
        </form>
    </div>
</body>
</html>
