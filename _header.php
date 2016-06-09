<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 08/04/2016
 * Time: 09:18
 */


session_start();
include_once "Controller/DatabaseAccess.php";
include_once "Entities/Ligne.php";
include_once "Entities/Sport.php";
include_once "Entities/Bordereau.php";
include_once "Entities/Tresorier.php";
include_once "Entities/Demandeur.php";
include_once "Entities/Adherent.php";
include_once "Entities/Ligne.php";
include_once "Entities/Association.php";
include_once "Controller/BordereauController.php";
include_once "Controller/UsersController.php";
include_once "Controller/LineController.php";
include_once "Controller/AssociationController.php";

// Récupération de l'utilisateur courant
if (isset($_SESSION['userInfo'])){
    $userInfo = unserialize($_SESSION['userInfo']);
    if ($userInfo->getLevel() > 0){
        $associationId = $userInfo->getAssociation();
        $controller = new UsersController();
        $associationUser = $controller->getAssociation($associationId);
        $sport = $controller->getSport($associationUser['sportId']);
        $association = new Association($associationUser['id'], $associationUser['name'], $associationUser['managerId'], $associationUser['sportId']);
        $_SESSION['association'] = serialize($association);
    }
}

// logout
if (isset($_REQUEST["logout"])) {
    session_unset();
    header('Location: index.php');
}




?>
<!doctype html>
<html>
<head>
    <title>Maison des Ligues Lorraine</title>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/css/foundation.css" />
    <link rel="stylesheet" href="style/css/style.css" />
    <link rel="stylesheet" href="style/font-awesome/css/font-awesome.min.css" />
    <script src="style/js/vendor/modernizr.js"></script>
    <script src="style/js/vendor/jquery.js"></script>
    <script src="style/js/foundation/foundation.js"></script>
    <script src="style/js/vendor/fastclick.js"></script>
    <script src="style/js/foundation/foundation.tab.js"></script>
    <script src="style/js/foundation/foundation.reveal.js"></script>
    <script src="style/js/foundation/foundation.orbit.js"></script>
    <script src="style/js/foundation/foundation.slider.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myModal').foundation( 'open')
        });
    </script>
    <script type="text/javascript">
        $(document).foundation('reveal', 'reflow');
    </script>
</head>
<body class="mainContent">
<!--Bloc d'identification -->
<div class="sticky">
    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
        <ul class="title-area">
            <li class="name">
                <h1><a href="index.php"><?php if (isset($associationUser)) {echo "Ligue de " . $sport['name'] ." de Lorraine - Association '" .$associationUser['name']. "'";} else { echo " Maison des Ligues de Lorraine ";}?></a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <?php if(!isset($_SESSION['userInfo'])){

            ?>
            <ul class="right">
                <li class=""><a href="#" data-reveal-id="loginModal" class="">Se connecter</a></li>
            </ul>
            <ul class="right">
                <li class=""><a href="#" data-reveal-id="registerModal" class="">S'enregistrer</a></li>
            </ul>
            <?php }
            else {
            ?>
                <ul class="right">
                    <li class=""><a href="<?php echo $_SERVER["PHP_SELF"]; ?>?logout" class=""><i class="fa fa-sign-out fa-2x"></i></a></li>
                </ul>
                <?php
                if($userInfo->getLevel() > 0 ) {
                ?>
                    <ul class="right">
                        <li class=""><a href="associationArchives.php"  class="">Demandes de don archivées</a></li>
                    </ul>
                    <ul class="right">
                        <li class=""><a href="associationManager.php"  class="">Gestion des demandes de don</a></li>
                    </ul>
                    <ul class="right">
                        <li class=""><a href="associationAdherents.php"  class="">Gestion des adhérents</a></li>
                    </ul>
                <?php }
                else {
                ?>
                    <ul class="right">
                        <li class=""><a href="demandeurArchives.php"  class="">Bordereaux archivés</a></li>
                    </ul>
                    <ul class="right">
                        <li class=""><a href="demandeurManager.php"  class="">Gestion des bordereaux</a></li>
                    </ul>
                    <ul class="right">
                        <li class=""><a href="add.php"  class="">Nouveau bordereau</a></li>
                    </ul>
                <?php }?>
            <?php } ?>
        </section>
    </nav>
</div>




<div class="row">
    <div class=" small-12 columns">
        <!--Modal de log in -->
        <div id="loginModal" class="reveal-modal tiny" data-reveal aria-labelledby="loginTitle" aria-hidden="true" role="dialog">
            <div id="loginModalContent" class="text-center">
                <form action="Actions/login.php" method="POST">
                    <h2 id="loginTitle">Connexion</h2>
                    <div class="separator"><span></span></div>
                    <br>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="email" class="right inline">Email</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="email" name="email" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="password" class="right inline">Mot de passe</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="password" id="password" name="password" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 text-center columns">
                            <button type="submit" class="small align-center">Se connecter</button>
                        </div>
                    </div>
                </form>
            </div>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>
        <!--Register Modal-->
        <div id="registerModal" class="reveal-modal tiny" data-reveal aria-labelledby="registerTitle" aria-hidden="true" role="dialog">
            <div id="registerModalContent" class="text-center">
                <form action="Actions/register.php" method="POST">
                    <h2 id="registerTitle">Créer un compte</h2>
                    <div class="separator"><span></span></div>
                    <br>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="lastName" class="right inline">Nom *</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="firstName" class="right inline">Prénom *</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="email" class="right inline">Email *</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="password" class="right inline">Mot de passe *</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="password" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="checkPassword" class="right inline">Confirmer le mot de passe *</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="password" id="checkPassword" name="checkPassword" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="adress" class="right inline">Rue</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="adress" name="adress" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="town" class="right inline">Ville</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="town" name="town" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="postalCode" class="right inline">Code postal</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="postalCode" name="postalCode" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 text-right columns">
                            * Champs obligatoires
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 text-center columns">
                            <button type="submit" class="small align-center">S'enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>
    </div>
</div>


