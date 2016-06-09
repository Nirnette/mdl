<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 18:20
 */

class AssociationController {

    public function getAllBordereaux($associationId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_bordereau where associationId = :associationId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':associationId', $associationId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getAdherent($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false) {
            $sql = "SELECT *  FROM mrbs_adherent WHERE id = :id ";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }
    }

    public function getAllAdherents($associationId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_adherent where associationId = :associationId";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':associationId', $associationId, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function addAdherent($licence, $lastName, $firstName, $associationId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
                $sql = "INSERT INTO mrbs_adherent(licence, lastName, firstName, associationId) VALUES ( :licence, :lastName, :firstName, :associationId)";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':licence', $licence);
            $prep->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $prep->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $prep->bindValue(':associationId', $associationId, PDO::PARAM_INT);
            $prep->execute();
            $prep->closeCursor();

        }
    }

    public function editAdherent($id, $licence, $lastName, $firstName, $associationId)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "UPDATE mrbs_adherent SET licence = :licence, lastName = :lastName, firstName = :firstName, associationId = :associationId WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindValue(':id', $id, PDO::PARAM_INT);
            $prep->bindValue(':licence', $licence, PDO::PARAM_INT);
            $prep->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $prep->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $prep->bindValue(':associationId', $associationId, PDO::PARAM_INT);
            $prep->execute();
            $prep->closeCursor();

        }
    }

    public function deleteAdherent($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false) {
            $sql = "DELETE FROM mrbs_adherent WHERE id = '" . $id . "' ";
            $prep = $pdo->prepare($sql);
            $prep->execute();
            $prep->closeCursor();
        }
    }
}