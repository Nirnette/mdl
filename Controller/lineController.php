<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 10/04/2016
 * Time: 18:40
 */

class LineController{

    public function getAllMotifs()
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_motif";
            $prep = $pdo->prepare($sql);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getMotif($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_motif WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getAllCh()
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_taux_kilometrique";
            $prep = $pdo->prepare($sql);
            $prep->execute();
            $result = $prep->fetchAll();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }

    public function getCh($id)
    {
        $db = new DataBaseAccess();
        $pdo = $db->connect();
        if ($pdo != false)
        {
            $sql = "SELECT * FROM mrbs_taux_kilometrique WHERE id = :id";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(':id', $id, PDO::PARAM_INT);
            $prep->execute();
            $result = $prep->fetch();
            $prep->closeCursor();
            return $result;
        }

        return null;
    }


}