<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 01/04/2016
 * Time: 11:48
 */

class DatabaseAccess {
    function connect() {
        $pdo = null;
        try {
            $pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=mrbs', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
        } catch (PDOException $err) {
            $messageErreur = $err->getMessage();
            error_log($messageErreur, 0);
        }
        return $pdo;
    }

    function userConnect ($email, $password){
        $pdo = $this->connect();
        if ($pdo != false){
            $sql ="SELECT * from mrbs_users"." where email=:email and password=:password";
            $prep = $pdo->prepare($sql);
            $prep->bindParam(":email", $email,PDO::PARAM_STR);
            $prep->bindParam(":password", $password, PDO::PARAM_STR);
            $prep->execute();
            $resultat= $prep->fetch();
            if ($prep->rowCount() == 1 ){
                $prep->closeCursor();
                return $resultat;
            }
            $prep->closeCursor();
        }
        return null;
    }

    function userCreate($firstName, $lastName, $email, $password, $level, $adress, $town, $postalCode){

        $pdo = $this->connect();
        if ($pdo == null)
        {
            return false;
        }
        $register = $pdo->prepare('INSERT INTO mrbs_users(firstname, name, email, password, level, adress, town, postalCode)
                                  VALUES (:firstname, :name, :email, :password, :level, :adress, :town, :postalCode)');

        $register->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $register->bindValue(':password', md5($password), PDO::PARAM_STR);
        $register->bindValue(':name', $lastName, PDO::PARAM_STR);
        $register->bindValue(':email', $email, PDO::PARAM_STR);
        $register->bindValue(':level', $level, PDO::PARAM_STR);
        $register->bindValue(':adress', $adress, PDO::PARAM_STR);
        $register->bindValue(':town', $town, PDO::PARAM_STR);
        $register->bindValue(':postalCode', $postalCode, PDO::PARAM_STR);

        return ($register->execute());

    }
}



