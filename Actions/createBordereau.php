<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 15:29
 */
session_start();
include_once "../Controller/DatabaseAccess.php";
include_once "../Entities/Ligne.php";
include_once "../Entities/Sport.php";
include_once "../Entities/Bordereau.php";
include_once "../Entities/Tresorier.php";
include_once "../Entities/Demandeur.php";
include_once "../Entities/Adherent.php";
include_once "../Entities/Ligne.php";
include_once "../Entities/Association.php";
include_once "../Controller/BordereauController.php";
include_once "../Controller/UsersController.php";
include_once "../Controller/LineController.php";

if (isset($_SESSION['userInfo'])){
    $userInfo = unserialize($_SESSION['userInfo']);
    $controller = new UsersController();

    if (isset($_POST['assoc'])) {
        $idAssoc = $_POST['assoc'];

        $association = $controller->getAssociation($idAssoc);
        $_SESSION['assoc'] = serialize($association);

        $bordereauxDemandeur = $controller->getAllBordereaux($userInfo->getId());
        $testExistence = false;
        foreach ($bordereauxDemandeur as $bordereauTest){
            $test = new Bordereau($bordereauTest['id'], $bordereauTest['demandeurId'], $bordereauTest['associationId'], $bordereauTest['locked']);

            if ($test->getAssociation() == $idAssoc)
            {
                $testExistence = true;
                break;
            }
        }

        if ($testExistence == false){
            $locked = false;
            $controller->createBordereau($userInfo->getId(), $association['id'], $locked);
            $callBordereau = $controller->getBordereau($userInfo->getId(), $association['id']);
            $bordereau = new Bordereau($callBordereau['id'], $callBordereau['demandeurId'], $callBordereau['associationId'], $locked);
        }
        else {
            $callBordereau = $controller->getBordereau($userInfo->getId(), $idAssoc);
            if ($callBordereau['locked'] == "false"){
                $locked = false;
            }
            elseif ($callBordereau['locked'] == "true"){
                $locked = true;
            }
            $bordereau = new Bordereau($callBordereau['id'], $callBordereau['demandeurId'], $callBordereau['associationId'], $locked);
        }

        $_SESSION['bordereau'] = serialize($bordereau);
        header('Location: ../bordereau.php');
    }
}
