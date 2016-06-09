<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 16:29
 */

include_once "_header.php";

$controller = new UsersController();

$sports = $controller->getAllSports();

if (isset($_SESSION['userInfo'])){
    $userInfo = unserialize($_SESSION['userInfo']);


    if (isset($_POST['sport'])) {
        $id = $_POST['sport'];
        $object = $controller->getSport($id);
        $sport = new Sport($object['id'], $object['name']);
        $associations = $controller->getAllAssociations($id);
        $_SESSION['sport'] = serialize($sport);
    }

    if (isset($_SESSION['sport']))
    {
        $objectSport = unserialize($_SESSION['sport']);
    }

?>




<div class="row">
    <div class="small-12 columns text-center">
        <h2>Création d'un nouveau bordereau</h2>

        <?php if(!isset($sport)){
        ?>
            <p>
                Afin de créer un nouveau bordereau, choisissez un sport de la ligue pour accéder à ses associations.
            </p>
            <div class="small-6 small-push-3 columns">
                <form action="add.php" method="POST" id="sportChoice">
                    <select name="sport" onchange="document.forms['sportChoice'].submit();">
                        <option value="-1">Sélectionner un sport</option>
                        <?php
                        foreach ($sports as $sportChoice) {
                            echo '<option value="' . $sportChoice['id'] . '">' . $sportChoice["name"] . '</option>';
                        }
                        ?>
                    </select>
                </form>
                <?php
                }
                ?>
            </div>
    </div>
    <div class="small-6 small-push-3 columns text-center">
        <?php
        if (isset($sport)) {
            ?>
            <p>
                Voici les associations de la ligue de <?php echo $sport->getName(); ?>
            </p>
            <div class="small-6 small-push-3 columns">
                <form action="Actions/createBordereau.php" method="POST" id="assocChoice">
                    <select name ="assoc">
                        <option value="-1">Sélectionner une association</option>
                        <?php
                            foreach ($associations as $associationChoice) {
                                echo '<option value="' . $associationChoice['id'] . '">' . $associationChoice["name"] . '</option>';
                            }
                        ?>
                    </select>
                    <button type="submit" class="small align-center">Valider</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
}
else echo "Vous 'navez pas les droits d'accès à cette page, merci de vous authentifier";
?>