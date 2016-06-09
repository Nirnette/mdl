<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 16/04/2016
 * Time: 16:40
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
include_once "../Controller/AssociationController.php";

$controller = new BordereauController();
if (isset($_POST['lock'])){
    $bordereau = unserialize($_SESSION['bordereau']);
    $value = true;
    $bordereau->setLocked($value);
    $controller->lockBordereau($bordereau->getId());
    $_SESSION['bordereau'] = serialize($bordereau);
    header('Location: ../bordereau.php');
}
if (isset($_POST['unlock'])){
    $bordereau = unserialize($_SESSION['bordereau']);
    $value = false;
    $bordereau->setLocked($value);
    $controller->unlockBordereau($bordereau->getId());
    $_SESSION['bordereau'] = serialize($bordereau);
    header('Location: ../bordereau.php');
}