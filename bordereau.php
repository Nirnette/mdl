<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 08/04/2016
 * Time: 12:00
 */
include_once "_header.php";

$bordereau = unserialize($_SESSION['bordereau']);


$lineController = new LineController();
$bordereauController = new BordereauController();

//Récupération de l'association
$associationId = $bordereau->getAssociation();
$associationCatch = $bordereauController->getAssociation($associationId);
$association = new Association($associationCatch['id'], $associationCatch['name'], $associationCatch['managerId'], $associationCatch['sportId']);
$bordereau->setAssociation($association);

// Récupérer les motifs pour le Modal d'ajout
$motifs = $lineController->getAllMotifs();

//Récupérer les valeurs fiscales
$chevaux = $lineController->getAllCh();

//Alimenter le bordereau avec les
$lines = $bordereauController->getLines($bordereau->getId());
if ($lines != null){
    foreach($lines as $line){
        $currentMotif = $line['motifId'];
        $motifId = $lineController->getMotif($currentMotif);
        $motif = $motifId['name'];
        $montantKm = $lineController->getCh($line['chCarId']);
        $currentLine = new Ligne($line['id'], $line['bordereauId'], $line['date'], $motif, $line['departure'], $line['arrival'], $line['km'],$montantKm['taux'], $line['peage'], $line['repas'], $line['hebergement']);
        $bordereau->addLine($currentLine);
    }
}
//Alimenter le bordereau avec les adhérents
$adherents = $bordereauController->getAdherents($bordereau->getId());
if ($adherents != null){
    foreach ($adherents as $adherent){
        $currentAdherent = new Adherent($adherent['id'], $adherent['licence'], $adherent['lastName'], $adherent['firstName'], $adherent['associationId']);
        $bordereau->addAdherent($currentAdherent);
    }
}

$_SESSION['bordereauChoice'] = serialize($bordereau);

//Alimenter le tableau des totaux
$totalkm = 0;
$totalPeage = 0;
$totalRepas = 0;
$totalHebergement = 0;
foreach ($bordereau->getLines() as $line){
    $totalkm += $line->getKm()*$line->getCh();
    $totalPeage += $line->getPeage();
    $totalRepas += $line->getRepas();
    $totalHebergement += $line->getHebergement();
}
$total = $totalkm + $totalPeage + $totalRepas + $totalHebergement;
$_SESSION['total'] = $total;

?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).foundation();
    });
</script>

<div class="row">
    <div class="small-12 columns text-center">
        <h4> Note de frais pour l'association '<?php echo $association->getName();?>' </h4><br>
            <div class="row">
                <div class="small-12 columns text-left">
                    Cette note de frais concerne les adhérents suivants : <br><br>
                    <?php
                    foreach ($bordereau->getAdherents() as $adherent){
                        echo "Licencié(e) n°".$adherent->getLicenceNumber() ." : " . $adherent->getLastName() ." ". $adherent->getFirstName() . "<br>";
                    }
                    ?>
                </div>
            </div>
            <br>
            <?php if ($bordereau->getLocked() == false)
            {
                ?>
        <form action="Actions/addAdherentToBordereau.php" method="POST">
            <div class="row">
                <div class="small-12 large-5 columns text-left">
                    Ajouter un adhérent par son n° de licence :
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns end">
                    <input type="number" id="licence" name="licence" >
                </div>
                <div class="small-12 large-2 text-left columns end">
                    <button type="submit" class="tiny align-center">Envoyer</button>
                </div>
            </div>
            <?php
            }
            ?>
        </form>
    </div>
    <div class="small-12 columns text-center">
        <table>
            <thead>
            <tr>
                <th width="10%">
                    date
                </th>
                <th>
                    motif
                </th>
                <th>
                    Trajet
                </th>
                <th width="12%">
                    Km - Montant
                </th>
                <th>
                    Montant péage
                </th>
                <th>
                    Montant repas
                </th>
                <th>
                    Montant hebergement
                </th>
                <?php
                if ($bordereau->isLocked() == false)
                {
                    echo    '<th colspan="2">
                                Gérer la note
                            </th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($lines != null){
                foreach($bordereau->getLines() as $line){
                    $suppress = "'suppress'";
                    echo '<tr>
                            <td>'.
                                $line->getDate().
                            '</td><td>'.
                                $line->getMotif().
                            '</td><td>'.
                                $line->getDeparture(). ' - '.$line->getArrival().
                            '</td><td>'.
                                $line->getKm(). " - ".$line->getCh()*$line->getKm().'€'.
                            '</td><td>'.
                                $line->getPeage().'€'.
                            '</td><td>'.
                                $line->getRepas().'€'.
                            '</td><td>'.
                                $line->getHebergement().'€'.
                            '</td>';

                    if ($bordereau->isLocked() == false){
                        echo    '<td>'.
                            '<form id="edit" action="editLine.php" method="POST">'.
                            '<input type="hidden" name="id" value="'.$line->getId().'"/>'.
                            '<button type="submit" class="tiny">Editer</button>'.
                            '</form>'.
                            '</td><td>'.
                            '<form id="suppress" action="Actions/suppressLine.php" method="POST">'.
                            '<input type="hidden" name="id" value="'.$line->getId().'"/>'.
                            '<button type="submit" class="tiny alert">Effacer</button>'.
                            '</form>'.
                            '</td>
                        </tr>';
                    }
                }
            }
            ?>
            </tbody>
        </table>
        <?php if ($userInfo->getLevel() == 0 && $bordereau->isLocked() == false){
            echo '<a href="#" data-reveal-id="addLineModal"  class="button small">Ajouter une note de frais</a>';
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="small-12 columns text-center">
        <table width="100%">
            <thead>
            <th>
                Total montant kilomètres
            </th>
            <th>
                Total montant péages
            </th>
            <th>
                Total montant repas
            </th>
            <th>
                Total montant hébergement
            </th>
            <th>
                Total bordereau
            </th>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $totalkm; ?>€
                </td>
                <td>
                    <?php echo $totalPeage; ?>€
                </td>

                <td>
                    <?php echo $totalRepas; ?>€
                </td>
                <td>
                    <?php echo $totalHebergement; ?>€
                </td>
                <td>
                    <?php echo $total; ?>€
                </td>
            </tr>
            </tbody>
        </table>
        <?php
        if ($userInfo->getLevel()> 0)
        {
            if ($bordereau->isLocked() == false)
            {
                echo    '<form id="edit" action="Actions/manageLockBordereau.php" method="POST">'.
                    '<input type="hidden" name="lock" value="'.$bordereau->getId().'"/>'.
                    '<button type="submit" class="small">Verrouiller et valider le bordereau</button>'.
                    '</form>';
            }
            else {
                echo    '<form id="edit" action="Actions/manageLockBordereau.php" method="POST">'.
                    '<input type="hidden" name="unlock" value="'.$bordereau->getId().'"/>'.
                    '<button type="submit" class="small">Déverrouiller le bordereau</button>'.
                    '</form>';
            }

        }
        ?>
        <a href="printBordereau.php" onclick="window.open(this.href); return false;"  class="button small">Imprimer le bordereau</a>
    </div>
</div>

<div class="row">
    <div class="small-12 columns">
        <div id="addLineModal" class="reveal-modal large" data-reveal aria-labelledby="addLineTitle" aria-hidden="true" role="dialog">
            <div id="addLineModalContent" class="text-center">
                <form action="Actions/addLine.php" method="POST">
                    <h2 id="addLineTitle">Ajouter une note de frais</h2>
                    <div class="separator"><span></span></div>
                    <br>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="date" class="right inline">Date</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="date" id="date" name="date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="motif" class="right inline">motif</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <select id="motif" name="motif" required>
                                <option value="-1">Choisissez un motif</option>
                                <?php
                                foreach ($motifs as $motif) {
                                    echo '<option value="' . $motif['id'] . '">' . $motif["name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="departure" class="right inline">Ville de départ</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="departure" name="departure" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="arrival" class="right inline">Ville d'arrivée</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="arrival" name="arrival" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="km" class="right inline">Kilomètres parcourus</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="number" id="km" name="km" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="chevaux" class="right inline">Valeur fiscale du véhicule utilisé</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <select id="chevaux" name="chevaux" >
                                <option value="-1">Choisissez une valeur</option>
                                <?php
                                foreach ($chevaux as $cheval) {
                                    echo '<option value="' . $cheval['id'] . '">' . $cheval["chevaux"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="peage" class="right inline">Montant péage</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="number" id="peage" name="peage" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="repas" class="right inline">Montant repas</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="number" id="repas" name="repas" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="hebergement" class="right inline">Montant hébergement</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="number" id="hebergement" name="hebergement" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 text-center columns">
                            <button type="submit" class="small align-center">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>
    </div>
</div>



