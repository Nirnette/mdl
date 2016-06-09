<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 14/04/2016
 * Time: 17:55
 */

include_once "_header.php";

if ($userInfo->getLevel() > 0){

    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $controller = new AssociationController();

        $association = unserialize($_SESSION['association']);

        $select = $controller->getAdherent($id);
        $adherent = new Adherent($select['id'], $select['licence'], $select['firstName'], $select['lastName'], $select['associationId']);
        $_SESSION['adherent'] = serialize($adherent);


    }

?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).foundation();
    });
</script>

<div class="row">
    <div class="small-12 large-8 columns text-center">
        <form action="Actions/editAdherent.php" method="POST">
            <h2 id="addLineTitle">Editer l'adhérent</h2>
            <div class="separator"><span></span></div>
            <br>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="licence" class="right inline">N° de licence</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="number" id="licence" name="licence" value="<?php echo $adherent->getLicenceNumber(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="lastName" class="right inline">Nom</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="text" id="lastName" name="lastName" value="<?php echo $adherent->getLastName(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="firstName" class="right inline">Prénom </label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="text" id="firstName" name="firstName" value="<?php echo $adherent->getFirstName(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 text-center columns">
                    <button type="submit" class="small align-center">Valider</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    }
    else echo "Vous 'navez pas les droits d'accès à cette page, merci de vous authentifier";
?>