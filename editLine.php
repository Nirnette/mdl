<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 18:01
 */

include_once "_header.php";

if (isset($_SESSION['userInfo'])){


    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $controller = new BordereauController();
        $lineController = new LineController();
        $bordereau = unserialize($_SESSION['bordereau']);
        $motifs = $lineController->getAllMotifs();

        $select = $controller->getLine($id);
        $line = new Ligne($select['id'],$select['bordereauId'],$select['date'], $select['motifId'], $select['departure'], $select['arrival'], $select['km'], $select['chCarId'], $select['peage'], $select['repas'], $select['hebergement']);
        $lineMotif = $line->getMotif();
        $motifName = $lineController->getMotif($lineMotif);
        $_SESSION['line'] = serialize($line);

    //Récupérer les valeurs fiscales
        $chevaux = $lineController->getAllCh();
        $chevalChoice = $lineController->getCh($line->getCh());

    }

?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).foundation();
    });
</script>

<div class="row">
    <div class="small-12 large-8 columns text-center">
        <form action="Actions/editLine.php" method="POST">
            <h2 id="edit LineTitle">Editer cette note de frais</h2>
            <div class="separator"><span></span></div>
            <br>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="date" class="right inline">Date</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="date" id="date" name="date" value="<?php echo $line->getDate(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="motif" class="right inline">motif</label>
                </div>
                <div class="small-12 large-9 columns">
                    <select id="motif" name="motif" >
                        <option value="<?php echo $motifName["id"]. '"> '.$motifName['name']; ?></option>
                        <?php
                        foreach ($motifs as $motif) {
                            if ($motif['name'] != $motifName['name']){
                                echo '<option value="' . $motif['id'] . '">' . $motif["name"] . '</option>';
                            }
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
                    <input type="text" id="departure" name="departure" value="<?php echo $line->getDeparture(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="arrival" class="right inline">Ville d'arrivée</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="text" id="arrival" name="arrival" value="<?php echo $line->getArrival(); ?>" >
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="km" class="right inline">Kilomètres parcourus</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="number" id="km" name="km" value="<?php echo $line->getKm(); ?>">
                </div>
            </div>
                <div class="row">
                    <div class="small-12 large-3 columns">
                        <label for="chevaux" class="right inline">Valeur fiscale du véhicule utilisé</label>
                    </div>
                    <div class="small-12 large-9 columns">
                        <select id="chevaux" name="chevaux" >
                            <option value="<?php echo $line->getCh(). '"> '.$chevalChoice['chevaux']; ?></option>
                            <?php
                            foreach ($chevaux as $cheval) {
                                if ($cheval['chevaux'] != $chevalChoice['chevaux']) {
                                    echo '<option value="' . $cheval['id'] . '">' . $cheval["chevaux"] . '</option>';
                                }
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
                    <input type="number" id="peage" name="peage" value="<?php echo $line->getPeage(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="repas" class="right inline">Montant repas</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="number" id="repas" name="repas" value="<?php echo $line->getRepas(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-3 columns">
                    <label for="hebergement" class="right inline">Montant hébergement</label>
                </div>
                <div class="small-12 large-9 columns">
                    <input type="number" id="hebergement" name="hebergement" value="<?php echo $line->getHebergement(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 text-center columns">
                    <button type="submit" class="small align-center">Valider</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
}
else echo "Vous 'navez pas les droits d'accès à cette page, merci de vous authentifier";
?>