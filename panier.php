<?php
session_start();
include 'functions/useful.php';

$total = totalPanier($_SESSION);
if (isset($_POST) && !empty($_POST)) {

    //-----------------------------------------------------------------------------------------------------------------
    // ajout article au panier
    //-----------------------------------------------------------------------------------------------------------------
    if (isset($_POST['ajout']) && $_POST['ajout'] == "mettre à jour") {
        //echo 'passe' . '<br>';
        $myPost = $_POST;
        $u = 0;
        foreach ($_POST as $key => $value) {
            if (is_numeric($key)) {
                $u = $key + 1;
                if (!array_key_exists('id_' . $u, $_SESSION)) {
                    $_SESSION['id_' . $u] = ['qts' => 1];
                }
            }
        }
    }
    //-----------------------------------------------------------------------------------------------------------------
    // delete dynamique----------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------

    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 10) == "deleteItem") {
           // echo "method delete de ouf <br>" . 'id a delete : ' . substr($key, 10) . '<br>';
            unset ($_SESSION['id_' . substr($key, 10)]);
        }
    }

    //-----------------------------------------------------------------------------------------------------------------
    // recalcule du prix global
    //-----------------------------------------------------------------------------------------------------------------
    $total = totalPanier($_SESSION);
    if (isset($_POST['recalcule'])) {
        //echo " method recalcule <br>";
        // mise à jour Qts et msgError
        foreach ($_POST as $key => $value) {
            // si on a un input du type modiQts
            if (substr($key, 0, 8) == "modifQts") {
                // si on est numeric
                if (is_numeric($value)) {
                    $_SESSION['id_' . substr($key, 8)] ['qts'] = $value;
                } else {
                   // echo "'msgError'.substr($key, 8)]";
                    $_SESSION['msgError' . substr($key, 8)] = "valeur numérique Obligatoire!";
                }
            }
        }
        // recalcule du prix final
        $total = totalPanier($_SESSION);
    }

    //-----------------------------------------------------------------------------------------------------------------
    // vider le panier session destroy
    //-----------------------------------------------------------------------------------------------------------------
    if (isset($_POST['vider'])) {
        session_destroy();
        header('Location: catalogue2.php');
    }
}


/*
 echo "----------------------------------------------------------<br>Session : ";
var_dump($_SESSION);
echo '<br>';
echo "----------------------------------------------------------<br>";
*/

// affecte la listes des articles au format Array;
$articles = generateCatalogue();


?>
<!--// front end
//--------------------------------------------------------------- -->
<form action="panier.php" method="post">
    <?php
    foreach ($_SESSION as $key => $value) {
        // on recupère  l'id sans le prefixe
        $k = substr($key, 3);
        //echo '<br>' . ($k);
        // test si la cle n'est pas msgError
        if (substr($key, 0, 3) == "id_") {

            // l'article existe t'il dans l'array d'article
            if (isExistArticle($k)) {
                //echo " exist dans la base" . "<br>";
                $art = getArticleInfo($k);
                var_dump($art);
                ?>
                <input type="text" name="modifQts<?php echo $art['id'] ?>"
                       value="<?php echo $_SESSION['id_' . $k]['qts'] ?>">
                <?php if (isset($_SESSION['msgError' . $art['id']])) {
                    // on affiche le message d'erreur pour cette Qts
                    echo $_SESSION['msgError' . $art['id']];
                    //on supprime le message d'errur apres usage
                    unset($_SESSION['msgError' . $art['id']]);
                } ?>
                <input type="submit" name="deleteItem<?php echo $art['id'] ?>" value="supprimer cet article">
                <?php
            }
        }
    }

    ?><br>
    <input type="submit" id="" name="recalcule" value="recalculer le panier">
    <input type="submit" id="" name="vider" value="vider le panier">
    <br>
    <?php echo "Total  : " . $total?>

</form>
