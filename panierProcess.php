<?php
session_start();
include 'functions/useful.php';

// MAJ QTS
$msgError = "";
var_dump($_POST);




if (isset($_POST) && !empty($_POST)) {
    //var_dump($_POST);
    foreach ($_POST as $key => $value) {
        if (is_numeric($key)) {
            if ($value != "delete" && is_numeric($value) ) {
                //$_SESSION['Qts'][$key] = $value;
                //$_SESSION['QtsMemory'][$key] = $value;
                //echo "> id :" . $key . ' - Qts : ' . $value  . ' - QtsMemo : ' . $value .' || ';
            }else{
                //
                //echo "> id :" . $key . ' - Qts : ' . $value  . ' - QtsMemo : ' . $_SESSION['Qts'][$key] .' || ';
                //$_SESSION['Qts'][$key] = $_SESSION['QtsMemory'][$key];
                $msgError = "Veuillez entrer une valeur numérique Positive";
            }
        }
    }
}
echo '<br>';
var_dump($_SESSION);

// recuperer la listes des articles au format Array;
$articles = generateCatalogue();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en Ligne</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">NgShop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="catalogue.php">Catalogue<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="catalogue2.php">Panier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>

            </ul>
        </div>
    </nav>
</header>
<main>

    <div class="container-fluid">
        <?php include 'header.php'; ?>
    </div>


    <?php

    if (isset($myPost) && !empty($myPost)) {


        ?>
        <div class="container">
            <form action="panierProcess.php" method="post">
                <div class="row">
                    <h1 class="badge  w-100 p-3 m-3">Article(s) ajouté(s)</h1>
                    <?php if (!empty($msgError)) { ?>
                        <span class="w-100 p-3 bg-danger text-white text-center"><?php echo $msgError ?></span>
                    <?php } ?>
                </div>
                <div class="row">

                    <?php
                    $total = 0;

                    // parcourir les articles dans le catalogue
                    foreach ($myPost as $key => $value) {
                        if (is_numeric($key)) {
                            $k = $key-1;


                            ?>
                            <div class="col-md-12 d-flex flex-inline justify-content-between align-items-center">

                                <img src="<?php echo $articles[$k]['url']; ?> " class="art-img-px" width="45"
                                     height="45" alt="...">


                                <?= $articles[$k]['nom'] ?>

                                <p class="p-3 m-3">
                                    <?= $articles[$k]['desc'] ?>
                                    <!-- QTS   -->
                                    <input type="text" name="<?php echo $articles[$k]['id'] ?>"
                                           id="<?php echo $articles[$k]['id'] ?>" value="<?php echo rtrim($value); ?>">

                                    <span class="bg-primary text-white p-3"><?= $articles[$k]['prix'] . "  " . MajDevise("euros") ?></span>
                                    <!-- DELETE   -->
                                    <input type="submit" name="<?php echo $articles[$k]['id'] ?>"
                                           id="<?php echo $articles[$k]['id'] ?>" value="delete"
                                           class="btn btn-outline-secondary">
                                </p>

                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="col-sm-12 d-flex flex-row justify-content-end align-items-center p-3 m-0">
                        <?php echo "Total : " . RecalculatePanier($myPost); ?>
                    </div>
                    <div class="col-sm-12 d-flex flex-row justify-content-end align-items-center p-3 m-0">
                        <input type="submit" name="Recalculer" id="Recalculer" value="Recalculer"
                               class="btn btn-outline-secondary">
                    </div>

                </div>
            </form>
        </div>
        <?php
    }

    ?>
</main>
<footer>

</footer>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
</script>
</body>

</html>