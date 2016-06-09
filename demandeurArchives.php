<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 16/04/2016
 * Time: 15:33
 */

include_once "_header.php";

$controller = new UsersController();
$bController = new BordereauController();

if (isset($_SESSION['userInfo'])){
    $userInfo = unserialize($_SESSION['userInfo']);



$appelBordereaux = $controller->getAllBordereaux($userInfo->getId());



?>

<div class="row">
    <div class="small-12 columns text-center">
        <p>
        <h2>Accédez à vos bordereaux archivés</h2>
        </p>
        <div class="small-6 small-push-3 columns">
        <form action="Actions/getToBordereau.php" method="POST">
            <select name="bordereau">
                <option value="-1">Selectionner un bordereau</option>
                <?php
                foreach ($appelBordereaux as $bordereauChoice)
                {
                    if ($bordereauChoice['locked'] == 'true')
                    {
                        $associationCourante = $bController->getAssociation($bordereauChoice['associationId']);
                        echo '<option value="' . $associationCourante["id"] . '">' .$userInfo->getLastName() . " " .$userInfo->getFirstName() ." - ". $associationCourante["name"] . '</option>';
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