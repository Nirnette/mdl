<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 14/04/2016
 * Time: 18:29
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

if (isset($_POST['licence'])){
    $licence = $_POST['licence'];
    $aController = new AssociationController();
    $controller = new BordereauController();

    $bordereau = unserialize($_SESSION['bordereau']);
    $adherentCatch = $aController->getAdherent($licence);
    $controller->addAdherent($bordereau->getId(), $adherentCatch['id']);
    header('Location: ../bordereau.php');
}