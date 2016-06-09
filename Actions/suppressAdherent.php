<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 14/04/2016
 * Time: 17:55
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

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $controller = new AssociationController();
    $adherent = unserialize($_SESSION['adherent']);

    $controller->deleteAdherent($id);
    header('Location: ../associationAdherents.php');

}