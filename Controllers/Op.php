<?php
require_once "Functions.php";


$op = $_GET["option"];

switch ($op) {
    case "signin":
        $email = $_POST["txtEmail"];
        $pass = hash("sha512", md5($_POST["txtPassword"]));
        SignIn($email, $pass);
        break;

    case "sair":
        LogOut();
        break;

    case "signup":
        SignUP();
        break;

    case "registerProd":
        registerProd();
        break;

    case "addCart":
        $id = $_GET['id'];
        addCart($id);
        break;

    case "removeCart":
        $id = $_GET['id'];
        removeCart($id);
        break;
}
