<?php

require_once "CpfValidation.php";

function Conection()
{

    $con = new PDO("mysql:host=localhost;dbname=login", "root", "");

    return $con;
}


function SignUP()
{
    session_start();
    $con = Conection();

    $name = $_POST["txtName"];
    $birthdate = $_POST["txtNascimento"];
    $email = $_POST["txtEmail"];
    $cpf = $_POST["txtCPF"];
    $pass = hash("sha512", md5($_POST["txtPassword"]));

    if (isCpfValid($cpf) == false) {
        $_SESSION['erro'] = 1;
        $msg = "<div class='alerta text-center error'>CPF INVÁLIDO</div>";
        $_SESSION['msg'] = $msg;

        $_SESSION['logado'] = false;
        header("location: ../signup.php");
    }

    if (!empty($name && $email && $pass)) {

        $verify = $con->prepare("SELECT id from users WHERE email = :email");
        $verify->bindValue(":email", $email);
        $verify->execute();
        if ($verify->rowCount() > 0) {
            header("location: ../index.php");
        } else {
            $stmt = $con->prepare("INSERT INTO users(name, email, cpf, birthdate, passwd) VALUES(?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $cpf);
            $stmt->bindParam(4, $birthdate);
            $stmt->bindParam(5, $pass);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['logado'] = false;
                header("location: ../index.php");
            } else {
                header("location: ../signup.php");
            }
        }
    } else {
        $_SESSION['erro'] = 1;
        $msg = "<div class='alerta error'>Preencha os campos</div>";
        $_SESSION['msg'] = $msg;

        $_SESSION['logado'] = false;
        header("location: ../signup.php");
    }
}

function LogOut()
{
    session_start();
    $_SESSION['logado'] = 'false';

    session_destroy();

    header("location: ./index.php");
}


function SignIn($email, $pass)
{
    session_start();

    $con = Conection();
    $number = $_SESSION['number'];

    if ($_SESSION['number'] < 2) {
        if (!empty($email && $pass)) {
            $verify = $con->prepare("SELECT id from users WHERE email = :email AND passwd = :pass");
            $verify->bindValue(":email", $email);
            $verify->bindValue(":pass", $pass);
            $verify->execute();

            if ($verify->rowCount() > 0) {
                while ($row = $verify->fetch(PDO::FETCH_OBJ)) {
                    $id = $row->id;
                    $_SESSION['id'] = $id;
                }

                $_SESSION['erro'] = 0;

                $_SESSION['logado'] = true;

                $_SESSION['carrinho'] = [];

                header("location: ../home2.php");
            } else {
                $number++;
                $_SESSION['number'] = $number;
                $_SESSION['erro'] = 1;
                $msg = "<div class='alerta error'>usuario ou senha incorretos</div>";
                $_SESSION['msg'] = $msg;

                $_SESSION['logado'] = false;
                header("location: ../index.php");
            }
        } else {
            $number++;
            $_SESSION['number'] = $number;
            $_SESSION['erro'] = 1;
            $msg = "<div class='alerta error'>Preencha os campos</div>";
            $_SESSION['msg'] = $msg;

            $_SESSION['logado'] = false;
            header("location: ../index.php");
        }
    } else {
        $_SESSION['denied'] = true;
        header("location: ../index.php");
    }
}

function registerProd()
{
    $con = Conection();

    $name = $_POST["txtName"];
    $inve = $_POST["txtInve"];
    $price = $_POST["txtPrice"];
    $rati = $_POST["txtRati"];
    $decri = $_POST["txtDescri"];

    if (isset($_FILES['img1'])) {
        $img1_name = $_FILES['img1']['name'];
        $img1_type = $_FILES['img1']['type'];
        $img1_data = file_get_contents($_FILES['img1']['tmp_name']);
    } else {
        $img1_name = null;
        $img1_type = null;
        $img1_data = null;
    }

    if (isset($_FILES['img2'])) {
        $img2_name = file_get_contents($_FILES['img2']['name']);
        $img2_type = file_get_contents($_FILES['img2']['type']);
        $img2_data = file_get_contents($_FILES['img2']['tmp_name']);
    } else {
        $img2_name = null;
        $img2_type = null;
        $img2_data = null;
    }

    if (!empty($name && $inve && $price && $decri)) {

        $stmt = $con->prepare("INSERT INTO products(prod_name, prod_inve, prod_pric, prod_desc, prod_rati, prod_img1_name, prod_img1_type, prod_img1_data, prod_img2_name, prod_img2_type, prod_img2_data) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $inve);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $decri);
        $stmt->bindParam(5, $rati);

        $stmt->bindParam(6, $img1_name);
        $stmt->bindParam(7, $img1_type);
        $stmt->bindParam(8, $img1_data);

        $stmt->bindParam(9, $img2_name);
        $stmt->bindParam(10, $img2_type);
        $stmt->bindParam(11, $img2_data);


        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("location: ../home2.php");
        } else {
            $_SESSION['erroRegister'] = true;
            $msg = "<div class='alerta error'>Erro ao cadastrar</div>";
            $_SESSION['msg'] = $msg;
            header("location: ../registerProd.php");
        }
    } else {
        $_SESSION['erroRegister'] = true;
        $msg = "<div class='alerta error'>Preencha os campos</div>";
        $_SESSION['msg'] = $msg;
        header("location: ../registerProd.php");
    }
}

function addCart($id)
{
    session_start();
    if (isset($id)) {
        $array = $_SESSION['carrinho'];
        foreach ($array as $value) {
            if ($value == $id) {
                return header("location: ../cart.php");
            }
        }
        array_push($array, $id);
        $_SESSION['carrinho'] = $array;
        header("location: ../cart.php");
    } else {
        $_SESSION['erroBuy'] = true;
        $msg = "<div class='alerta error'>Erro ao comprar</div>";
        $_SESSION['msg'] = $msg;
        header("location: ../details.php?id=$id");
    }
}

function cart()
{
    session_start();
    $con = Conection();
    $allProd = [];
    $array = $_SESSION['carrinho'];
    foreach ($array as $id) {

        $verify = $con->prepare("SELECT * from products WHERE prod_id = :id");
        $verify->bindValue(":id", $id);
        $verify->execute();

        $row = $verify->fetch(PDO::FETCH_OBJ);
        array_push($allProd, $row);
    }

    return $allProd;
}

function removeCart($id)
{
    session_start();
    if (isset($id)) {
        $array = $_SESSION['carrinho'];
        $array = array_diff($array, array($id));
        $_SESSION['carrinho'] = $array;
        header("location: ../cart.php");
    } else {
        $_SESSION['erroBuy'] = true;
        $msg = "<div class='alerta error'>Erro ao tirar</div>";
        $_SESSION['msg'] = $msg;
        header("location: ../cart.php?id=$id");
    }
}
