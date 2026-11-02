<?php
session_start();

if ($_SESSION['id'] == null) {
    header('Location: login.php');
}

$nom = $_SESSION['nom'];

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center mt-5 bg-success text-white p-3">Bienvenue sur mon site!</h1>
    <h2 class="text-center mt-3">Vous êtes connecté(e) en tant que 
        <?= $_SESSION['nom']; ?>. Votre id est <?= $_SESSION['id']; ?></h2>

        <a name="" id="" class="btn btn-primary center" href="logout.php" role="button">Se déconnecter</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>