<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 16/04/2016
 * Time: 17:31
 */

include_once "_header.php";

$controller = new AssociationController();
$userController = new UsersController();



if (isset($_SESSION['userInfo'])){
    $userInfo = unserialize($_SESSION['userInfo']);
}

if ($userInfo->getLevel() > 0){

    $association = $userInfo->getAssociation();
    $appelBordereaux = $controller->getAllBordereaux($association);


    if (isset($_SESSION['sport']))
    {
        $objectSport = unserialize($_SESSION['sport']);
    }
?>




<div class="row">
    <div class="small-12 columns text-center">
        <p>
            <h2>Choisir le bordereau à consulter</h2>
        </p>
        <div class="small-6 small-push-3 columns text-center">

            <form action="Actions/getToAdminBordereau.php" method="POST">
                <select name="bordereau">
                    <option value="-1">Sélectionner un bordereau</option>
                    <?php
                    foreach ($appelBordereaux as $bordereauChoice)
                    {
                        $bordereau = new Bordereau($bordereauChoice['id'], $bordereauChoice['demandeurId'], $bordereauChoice['associationId'], $bordereauChoice['locked']);
                        if ($bordereauChoice['locked'] == 'true')
                        {
                            $demandeurId = $bordereau->getDemandeur();
                            $demandeur = $userController->getDemandeur($demandeurId);
                            $object = new Demandeur($demandeur['id'],$demandeur['name'],$demandeur['firstname'],$demandeur['email'],$demandeur['password'],$demandeur['level'],$demandeur['adress'],$demandeur['town'],$demandeur['postalCode']);
                            echo '<option value="' . $object->getId() . '"> Bordereau de ' .$object->getLastName() . " " .$object->getFirstName() . '</option>';
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="small align-center">Valider</button>
            </form>
        </div>
    </div>
</div>

<?php
}
else echo "Vous 'navez pas les droits d'accès à cette page, merci de vous authentifier";
?>