<?php

/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 16:18
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

if (isset($_POST['date'])){
    $controller = new BordereauController();
    $line = unserialize($_SESSION['line']);

    $id = $line->getId();
    $date = $_POST['date'];
    $motifAdd = $_POST['motif'];
    $departure = htmlentities($_POST['departure'], ENT_QUOTES);
    $arrival = htmlentities($_POST['arrival'], ENT_QUOTES);
    $km = $_POST['km'];
    $chevaux = $_POST['chevaux'];
    $peage = $_POST['peage'];
    $repas = $_POST['repas'];
    $hebergement = $_POST['hebergement'];
    $controller->editLine($id, $date, $motifAdd, $departure, $arrival, $km, $chevaux, $peage, $repas, $hebergement);
    header('Location: ../bordereau.php');
}