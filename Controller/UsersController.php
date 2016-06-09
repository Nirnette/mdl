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
include_once "BordereauController.php";
include_once "DatabaseAccess.php";

class UsersController {

    public function createBordereau($demandeurId, $associationId, $locked){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "INSERT INTO mrbs_bordereau(demandeurId, associationId, locked) VALUES (:demandeurId, :associationId, :locked)";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':demandeurId', $demandeurId);
            $prep->bindValue(':associationId', $associationId);
            $prep->bindValue(':locked', $locked);
            $prep->execute();
            $prep->closeCursor();
        }

    }

    public function getAllBordereaux($demandeurId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_bordereau where demandeurId = :demandeurId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':demandeurId', $demandeurId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getBordereau($demandeurId, $associationId){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_bordereau WHERE demandeurId = :demandeurId AND associationId = :associationId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':demandeurId', $demandeurId, PDO::PARAM_INT);
            $prep->bindParam(':associationId', $associationId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;

    }

    public function getAllSports(){

        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_sport";
            $prep = $pdo->prepare($sql);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getSport($sportId){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_sport WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $sportId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;

    }

    public function getAllAssociations($sportId){

        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_association where sportId = :sportId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':sportId', $sportId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getAssociation($id){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_association WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;

    }

    public function getDemandeur($id){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_users WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;

    }

    public function getAllDemandeurs($associationId){

        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_users where associationId = :associationId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':associationId', $associationId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getPassword($email){
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_users WHERE email = :email";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':email', $email, PDO::PARAM_STR);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;

    }

}