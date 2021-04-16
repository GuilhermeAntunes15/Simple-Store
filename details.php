<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Site PW</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<?php
require_once "Controllers/Functions.php";
$con = Conection();
session_start();

if ($_SESSION['logado'] == false) {
    header("location: index.php");
}

$id_s = $_GET['id'];

$verify = $con->prepare("SELECT * from products WHERE prod_id = :id");
$verify->bindValue(":id", $id_s);
$verify->execute();

$row = $verify->fetch(PDO::FETCH_OBJ);
?>

<body class="text-light" style="background-color: #040726;">
    <?php require_once "menu.php"; ?>
    <div class="container">
        <h1 class="my-4"><?= $row->prod_name ?><br /></h1>
        <div class="row">
            <div class="col-md-8">
                <?php echo "<img class='img-fluid' src='data:" . $row->prod_img1_type . ";base64," . base64_encode($row->prod_img1_data) . "'/>"; ?>
            </div>
            <div class="col-md-4">
                <h3 class="my-3">Descrição</h3>
                <p><?= $row->prod_desc ?></p>
                <h3 class="my-3">Detalhes</h3>
                <ul class="list-unstyled">
                    <li>Preço: <?= $row->prod_pric ?></li>
                    <li>Nota: <?= $row->prod_rati ?></li>
                    <li>Quantidade no Estoque: <?= $row->prod_inve ?></li>
                </ul>
                <a href="Controllers/Op.php?option=addCart&id=<?= $row->prod_id ?>"><button class="btn btn-success">Comprar</button></a>
            </div>
        </div>
        <h3 class="my-4">Related Projects<br /></h3>
        <div class="row">
            <div class="col-sm-6 col-md-3 mb-4"><a href="#"><img class="img-fluid" src="http://placehold.it/500x300" /></a></div>
            <div class="col-sm-6 col-md-3 mb-4"><a href="#"><img class="img-fluid" src="http://placehold.it/500x300" /></a></div>
            <div class="col-sm-6 col-md-3 mb-4"><a href="#"><img class="img-fluid" src="http://placehold.it/500x300" /></a></div>
            <div class="col-sm-6 col-md-3 mb-4"><a href="#"><img class="img-fluid" src="http://placehold.it/500x300" /></a></div>
        </div>
    </div>
</body>

</html>