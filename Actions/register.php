<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 08/04/2016
 * Time: 09:22
 */
include_once "../Entities/Tresorier.php";
include_once "../Entities/Demandeur.php";
include_once "../Controller/UsersController.php";
session_start();

// register + login
if (isset($_POST['lastName'])) {
    if ($_POST['password'] == $_POST['checkPassword'])
    {
        $userCreate = new DataBaseAccess();
        $lastName = htmlentities($_POST['lastName'], ENT_QUOTES);
        $firstName = htmlentities($_POST['firstName'], ENT_QUOTES);
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $password = $_POST['password'];
        $level = 0;
        $adress = htmlentities($_POST['adress'], ENT_QUOTES);
        $town = htmlentities($_POST['town'], ENT_QUOTES);
        $postalCode = htmlentities($_POST['postalCode'], ENT_QUOTES);
        $userCreate->userCreate($firstName, $lastName, $email, $password, $level, $adress, $town, $postalCode);

        $loggedUser = $userCreate->userConnect($_POST['email'], md5($_POST['password']));
        $userInfo = new Demandeur($loggedUser['id'],$loggedUser['name'],$loggedUser['firstname'],$loggedUser['email'],$loggedUser['password'],$loggedUser['level'],$loggedUser['adress'],$loggedUser['town'],$loggedUser['postalCode']);
        $_SESSION['userInfo'] = serialize($userInfo);

        header('Location: ../index.php');
    }
}