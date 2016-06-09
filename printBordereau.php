<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 16/04/2016
 * Time: 17:57
 */

session_start();
include_once "Controller/DatabaseAccess.php";
include_once "Entities/Ligne.php";
include_once "Entities/Sport.php";
include_once "Entities/Bordereau.php";
include_once "Entities/Tresorier.php";
include_once "Entities/Demandeur.php";
include_once "Entities/Adherent.php";
include_once "Entities/Ligne.php";
include_once "Entities/Association.php";
include_once "Controller/BordereauController.php";
include_once "Controller/UsersController.php";
include_once "Controller/LineController.php";
include_once "Controller/AssociationController.php";
include_once "fpdf/fpdf.php";

$pdf = new FPDF();
$bController = new BordereauController();
$controller = new UsersController();

if (isset($_SESSION['userInfo'])) {

    $bordereau = unserialize($_SESSION['bordereauChoice']);

    $demandeurId = $bordereau->getDemandeur();
    $demandeurCatch = $controller->getDemandeur($demandeurId);
    $demandeur = new Demandeur($demandeurCatch['id'], $demandeurCatch['name'], $demandeurCatch['firstname'], $demandeurCatch['email'], $demandeurCatch['password'], $demandeurCatch['level'], $demandeurCatch['adress'], $demandeurCatch['town'], $demandeurCatch['postalCode']);

    $association = $bordereau->getAssociation();

    $time = localtime(time(), true);
    $year = $time['tm_year'] + 1900;
    $totalBordereau = 0;

    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 18);
    $pdf->Cell(0, 20, utf8_decode($association->getName()), 0, 1, 'C');
    $pdf->Cell(0, 5, "", 0, 1);

    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(100, 10, utf8_decode("Note de frais d'un bénévole"), 0, 0);
    $pdf->Cell(0, 10, utf8_decode("Année civile ") . $year, 0, 1, 'R');
    $pdf->Cell(0, 5, "", 0, 1);

    $pdf->Cell(50, 10, utf8_decode("Je soussigné(e)"), 0, 0);
    $pdf->SetFont("Arial", "", 13);
    $pdf->Cell(0, 10, utf8_decode($demandeur->getFirstName()) . " " . utf8_decode($demandeur->getLastName()), 0, 1);
    $pdf->Cell(0, 1, "", 0, 1);

    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(50, 10, "Demeurant ", 0, 0);
    $pdf->SetFont("Arial", "", 13);
    $pdf->Cell(0, 10, utf8_decode($demandeur->getAdress()) . ", " . utf8_decode($demandeur->getPostalCode()) . " " . utf8_decode($demandeur->getTown()), 0, 1);
    $pdf->Cell(0, 1, "", 0, 1);

    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(0, 10, "Certifie renoncer au remboursement des frais ci-dessous et les laisser", 0, 1);
    $pdf->Cell(50, 10, utf8_decode("à l'association "), 0, 0);
    $pdf->SetFont("Arial", "", 13);
    $pdf->Cell(70, 10, utf8_decode($association->getName()), 0, 0);
    $pdf->SetFont("Arial", "B", 13);
    $pdf->Cell(0, 10, "en tant que don. ", 0, 1);
    $pdf->Cell(0, 7, "", 0, 1);

    //Thead de la table.
    $pdf->SetFont("Arial", "", 10);
    $pdf->Cell(18, 10, "Date", 1, 0);
    $pdf->Cell(22, 10, "Motif", 1, 0);
    $pdf->Cell(35, 10, "Trajet", 1, 0);
    $pdf->Cell(26, 10, "Kms parcourus", 1, 0);
    $pdf->Cell(22, 10, "Cout trajet", 1, 0);
    $pdf->Cell(17, 10, utf8_decode("Péages"), 1, 0);
    $pdf->Cell(17, 10, "Repas", 1, 0);
    $pdf->Cell(25, 10, utf8_decode("Hébergement"), 1, 0);
    $pdf->Cell(15, 10, "Total", 1, 1);

    // Table des frais
    foreach ($bordereau->getLines() as $line) {
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(18, 10, $line->getDate(), 1, 0);
        $pdf->Cell(22, 10, utf8_decode($line->getMotif()), 1, 0);
        $pdf->Cell(35, 10, utf8_decode($line->getDeparture()) . " - " . utf8_decode($line->getArrival()), 1, 0);
        $pdf->Cell(26, 10, $line->getKm(), 1, 0);
        $pdf->Cell(22, 10, $line->getKm() * $line->getCh(), 1, 0);
        $pdf->Cell(17, 10, $line->getPeage(), 1, 0);
        $pdf->Cell(17, 10, $line->getRepas(), 1, 0);
        $pdf->Cell(25, 10, $line->getHebergement(), 1, 0);
        $total = $line->getKm() * $line->getCh() + $line->getPeage() + $line->getRepas() + $line->getHebergement();
        $totalBordereau += $total;
        $pdf->Cell(15, 10, $total, 1, 1);
    }
    $pdf->Cell(157, 10, utf8_decode("Montant total des frais de déplacement"), 1, 0);
    $pdf->Cell(40, 10, $totalBordereau . utf8_decode(' euros'), 1, 1);
    $pdf->Cell(0, 7, "", 0, 1);

    //Adhérents
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(0, 8, utf8_decode("Ce bordereau représente le(s) adhérent(s) suivant(s) :"), 0, 1);
    $pdf->SetFont("Arial", "", 12);
    foreach ($bordereau->getAdherents() as $adherent) {
        $pdf->Cell(0, 8, utf8_decode($adherent->getFirstName()) . ' ' . utf8_decode($adherent->getLastName()) . utf8_decode(', licence n° ') . utf8_decode($adherent->getLicenceNumber()), 0, 1);
    }
    $pdf->Cell(0, 2, "", 0, 1);

    $pdf->SetFont("Arial", "", 8);
    $pdf->Cell(0, 10, utf8_decode("Pour bénéficier du reçu de dons, cette note de frais doit être accompagnée de tous les justificatifs correspondants"), 0, 1, 'R');
    $pdf->Cell(0, 5, "", 0, 1);

    //Bloc de signature
    $pdf->SetFont("Arial", "", 12);
    $pdf->Cell(50, 10, "A ", 0, 0, 'R');
    $pdf->Cell(50, 10, "", 1, 0);
    $pdf->Cell(30, 10, "le ", 0, 0, 'R');
    $pdf->Cell(50, 10, "", 1, 1);
    $pdf->Cell(0, 5, "", 0, 1);
    $pdf->Cell(100, 10, utf8_decode("Signature du bénévole "), 0, 0, 'R');
    $pdf->Cell(80, 15, "", 1, 1);
    $pdf->Cell(80, 15, "", 0, 1);

    //Administration
    $pdf->Cell(100, 8, utf8_decode("Bloc réservé à l'association"), 1, 1);
    $pdf->Cell(100, 8, utf8_decode("N° d'ordre du reçu : "), 1, 1);
    $pdf->Cell(100, 8, utf8_decode("Remis le :"), 1, 1);
    $pdf->Cell(100, 12, utf8_decode("Signature du trésorier : "), 1, 1);


    $pdf->Output();

}
else echo "Vous n'avez pas les droits d'accès à cette page, merci de vous authentifier";
