<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

include("php/config.php");

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($con, $_POST['search_query']);
    $result = mysqli_query($con, "SELECT * FROM ksiazki WHERE tytul LIKE '%$search_query%'");
} else {
    $result = mysqli_query($con, "SELECT * FROM ksiazki");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Przeglądanie książek</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Przeglądanie Książek</h1>
            <form action="" method="post">
                <input type="text" name="search_query" placeholder="Wyszukaj książkę" value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" name="search">Szukaj</button>
            </form>
        </header>
        <div class="book-list">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="book">
                    <h2><?php echo htmlspecialchars($row['tytul']); ?></h2>
                    <p><strong>Autor:</strong> <?php echo htmlspecialchars($row['autor']); ?></p>
                    <p><strong>Cena:</strong> <?php echo htmlspecialchars($row['cena']); ?></p>
                    <a href="zamowienie.php?id_ksiazki=<?php echo $row['id_ksiazki']; ?>"><button class="btn">Zamów</button></a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
