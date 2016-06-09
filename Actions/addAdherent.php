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


// Validation de ligne
if (isset($_POST['licence'])) {

    $controller = new AssociationController();
    $association = unserialize($_SESSION['association']);

    $licence = $_POST['licence'];
    $lastName = htmlentities($_POST['lastName'], ENT_QUOTES);
    $firstName = htmlentities($_POST['firstName'], ENT_QUOTES);
    $associationId = $association->getId();

    $controller->addAdherent($licence, $lastName, $firstName, $associationId);
    header('Location: ../associationAdherents.php');

}