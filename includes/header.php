<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rossi CRUD</title>
    <link rel="icon" href="https://aspivina.github.io/web-resume/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/dfe09345d8.js" crossorigin="anonymous"></script>
</head>

<body style="
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;">
    <header>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                <img src="https://aspivina.github.io/web-resume/img/transparente.png" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                Crud de Usuarios
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MESSAGES -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php?login=true">Logout <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?login=true"><i class="fas fa-door-open"></i> Login <span class="sr-only">(current)</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>
    </header>