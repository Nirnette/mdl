<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 14/04/2016
 * Time: 16:55
 */

include_once "_header.php";

$association = unserialize($_SESSION['association']);

if (isset($_SESSION['userInfo'])){
    $userInfo = unserialize($_SESSION['userInfo']);
}

if ($userInfo->getLevel() > 0){

    $controller = new AssociationController();
    $adherents = $controller->getAllAdherents($association->getId())

?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).foundation();
    });
</script>

<div class="row">
    <div class="small-12 columns text-center">
        <p>
            <h2>Liste des adhérents de l'association '<?php echo $association->getName() ?>'</h2>
        </p>

    </div>
    <div class="small-12 large-6 large-centered text-center columns">
        <table >
            <thead>
            <tr>
                <th>
                    N° de licence
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th colspan="2">
                    Gérer l'adhérent
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($adherents != null){
                foreach($adherents as $adherent){
                    $currentAdherent = new Adherent($adherent['id'], $adherent['licence'], $adherent['firstName'], $adherent['lastName'], $adherent['associationId']);
                    $suppress = "'suppress'";
                    echo '<tr>
                            <td>'.
                        $currentAdherent->getLicenceNumber().
                        '</td><td>'.
                        $currentAdherent->getLastName().
                        '</td><td>'.
                        $currentAdherent->getFirstName().
                        '</td><td>'.
                            '<form id="edit" action="editAdherent.php" method="POST">'.
                                '<input type="hidden" name="id" value="'.$currentAdherent->getId().'"/>'.
                                '<button type="submit" class="tiny">Editer</button>'.
                            '</form>'.
                        '</td><td>'.
                            '<form id="suppress" action="Actions/suppressAdherent.php" method="POST">'.
                                '<input type="hidden" name="id" value="'.$currentAdherent->getId().'"/>'.
                                '<button type="submit" class="alert tiny">Effacer</button>'.
                            '</form>'.
                        '</td>
                        </tr>';
                }
            }
            ?>
            </tbody>
        </table>
        <a href="#" data-reveal-id="addAdherentModal"  class="button small">Ajouter un adhérent</a>
    </div>
</div>

<div class="row">
    <div class="small-12 columns">
        <div id="addAdherentModal" class="reveal-modal tiny" data-reveal aria-labelledby="addAdherentTitle" aria-hidden="true" role="dialog">
            <div id="addAdherentModalContent" class="text-center">
                <form action="Actions/addAdherent.php" method="POST">
                    <h2 id="addLineTitle">Ajouter un adhérent</h2>
                    <div class="separator"><span></span></div>
                    <br>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="licence" class="right inline">N° de licence</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="number" id="licence" name="licence" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="lastName" class="right inline">Nom</label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="lastName" name="lastName" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-3 columns">
                            <label for="firstName" class="right inline">Prénom </label>
                        </div>
                        <div class="small-12 large-9 columns">
                            <input type="text" id="firstName" name="firstName" >
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

<?php
}
else echo "Vous 'navez pas les droits d'accès à cette page, merci de vous authentifier";
?>