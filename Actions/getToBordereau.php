<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 16:13
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

if (isset($_SESSION['userInfo'])) {
    $userInfo = unserialize($_SESSION['userInfo']);
    $controller = new UsersController();

    if (isset($_POST['bordereau'])){
        $bordereauChoice = $controller->getBordereau($userInfo->getId(), $_POST['bordereau']);
        if ($bordereauChoice['locked'] == 'false'){
            $locked = false;
        }
        else {
            $locked = true;
        }
        $bordereauManage = new Bordereau($bordereauChoice['id'], $bordereauChoice['demandeurId'],$bordereauChoice['associationId'], $locked);
        $_SESSION['bordereau'] = serialize($bordereauManage);
        header('Location: ../bordereau.php');
    }


}