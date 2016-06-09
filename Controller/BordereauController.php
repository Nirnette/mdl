<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 09/04/2016
 * Time: 16:36
 */

//include_once "../Entities/Ligne.php";
//include_once "../Entities/Bordereau.php";
//include_once "../Entities/Tresorier.php";
//include_once "../Entities/Demandeur.php";
include_once "UsersController.php";
include_once "DatabaseAccess.php";


class BordereauController {

    public function getAssociation($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false) {
            $sql = "SELECT *  FROM mrbs_association WHERE id = '" . $id . "' ";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }
    }

    public function getLine($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false) {
            $sql = "SELECT *  FROM mrbs_line WHERE id = :id ";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }
    }

    public function getLines($bordereauId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_line where bordereauId = :bordereauId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':bordereauId', $bordereauId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function addLine($bordereauId, $date, $motif, $departure, $arrival, $km, $ch, $peage, $repas, $hebergement)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "INSERT INTO mrbs_line(bordereauId, date, motifId, departure, arrival, km, chCarId, peage, repas, hebergement) VALUES ( :bordereauId, :date, :motif, :departure, :arrival, :km, :ch, :peage, :repas, :hebergement)";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':bordereauId', $bordereauId, PDO::PARAM_INT);
            $prep->bindValue(':date', $date);
            $prep->bindValue(':motif', $motif, PDO::PARAM_INT);
            $prep->bindValue(':departure', $departure, PDO::PARAM_STR);
            $prep->bindValue(':arrival', $arrival, PDO::PARAM_STR);
            $prep->bindValue(':km', $km, PDO::PARAM_INT);
            $prep->bindValue(':ch', $ch);
            $prep->bindValue(':peage', $peage, PDO::PARAM_INT);
            $prep->bindValue(':repas', $repas, PDO::PARAM_INT);
            $prep->bindValue(':hebergement', $hebergement, PDO::PARAM_INT);
            $prep->execute();
            $prep->closeCursor();

        }
    }

    public function editLine($id, $date, $motif, $departure, $arrival, $km, $ch, $peage, $repas, $hebergement)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "UPDATE mrbs_line SET date = :date, motifId = :motif, departure = :departure, arrival = :arrival, km = :km, chCarId = :ch, peage = :peage, repas = :repas, hebergement = :hebergement WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':id', $id, PDO::PARAM_INT);
            $prep->bindValue(':date', $date);
            $prep->bindValue(':motif', $motif, PDO::PARAM_STR);
            $prep->bindValue(':departure', $departure, PDO::PARAM_STR);
            $prep->bindValue(':arrival', $arrival, PDO::PARAM_STR);
            $prep->bindValue(':km', $km, PDO::PARAM_INT);
            $prep->bindValue(':ch', $ch, PDO::PARAM_INT);
            $prep->bindValue(':peage', $peage, PDO::PARAM_INT);
            $prep->bindValue(':repas', $repas, PDO::PARAM_INT);
            $prep->bindValue(':hebergement', $hebergement, PDO::PARAM_INT);
            $prep->execute();
            $prep->closeCursor();

        }
    }

    public function deleteLine($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false) {
            $sql = "DELETE FROM mrbs_line WHERE id = '" . $id . "' ";
            $prep = $pdo->prepare($sql);
            $prep->execute();
            $prep->closeCursor();
        }
    }

    public function getAdherents($bordereauId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_adherent JOIN mrbs_adherent_bordereau ON mrbs_adherent.id = mrbs_adherent_bordereau.adherentId where bordereauId = :bordereauId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':bordereauId', $bordereauId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function addAdherent($bordereauId, $adherentId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "INSERT INTO mrbs_adherent_bordereau(bordereauId, adherentId) VALUES ( :bordereauId, :adherentId)";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':bordereauId', $bordereauId, PDO::PARAM_INT);
            $prep->bindValue(':adherentId', $adherentId, PDO::PARAM_INT);
            $prep->execute();
            $prep->closeCursor();

        }
    }

    public function lockBordereau($id){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "UPDATE mrbs_bordereau SET locked = :locked WHERE  id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':id', $id, PDO::PARAM_INT);
            $prep->bindValue(':locked', 'true', PDO::PARAM_STR);
            $prep->execute();
            $prep->closeCursor();

        }
    }

    public function unlockBordereau($id){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "UPDATE mrbs_bordereau SET locked = :locked WHERE  id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':id', $id, PDO::PARAM_INT);
            $prep->bindValue(':locked', 'false', PDO::PARAM_STR);
            $prep->execute();
            $prep->closeCursor();

        }
    }
}

