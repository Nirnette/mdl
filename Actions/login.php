<?php
/**
 * Created by PhpStorm.
 * User: Nini
 * Date: 12/04/2016
 * Time: 14:56
 */
include_once "../Entities/Tresorier.php";
include_once "../Entities/Demandeur.php";
include_once "../Controller/UsersController.php";
session_start();
$logUser = new DataBaseAccess();
if (isset($_POST['email'])&& isset( $_POST['password'])){
    $loggedUser = $logUser->userConnect($_POST['email'], md5($_POST['password']));

    if ($loggedUser != null) {
        if ($loggedUser['level'] > 0 )
        {
            $userInfo = new Tresorier($loggedUser['id'],$loggedUser['name'],$loggedUser['firstname'],$loggedUser['email'],$loggedUser['password'],$loggedUser['level'],$loggedUser['associationId']);
        }
        else {
            $userInfo = new Demandeur($loggedUser['id'],$loggedUser['name'],$loggedUser['firstname'],$loggedUser['email'],$loggedUser['password'],$loggedUser['level'],$loggedUser['adress'],$loggedUser['town'],$loggedUser['postalCode']);
        }

        $_SESSION['userInfo'] = serialize($userInfo);

    }
    header('Location: ../index.php');
}
else {
    header('Location: ../index.php');
}