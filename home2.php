<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Site PW</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Shopping-Grid.css">
</head>

<?php
require_once "Controllers/Functions.php";
$con = Conection();
session_start();

if ($_SESSION['logado'] == false) {
    header("location: index.php");
}
?>

<body style="background: #040726;">
    <?php require_once "menu.php"; ?>
    <div class="shopping-grid">
        <div class="container">
            <h3 class="text-light" align="center">Peças de Computador</h3>
            <div class="row">
                <?php
                $data = $con->query('SELECT * FROM products')->fetchAll();
                foreach ($data as $row) {
                ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="product-grid7">
                            <div class="product-image7">
                                <a href="details.php?id=<?= $row['prod_id'] ?>">
                                    <?php echo "<img class='pic-1' src='data:" . $row['prod_img1_type'] . ";base64," . base64_encode($row['prod_img1_data']) . "'/>"; ?>
                                    <?php echo "<img class='pic-2' src='data:" . $row['prod_img2_type'] . ";base64," . base64_encode($row['prod_img2_data']) . "'/>"; ?>
                                </a>
                                <ul class="social">
                                    <li><a href="details.php?id=<?= $row['prod_id'] ?>" class="fa fa-search"></a></li>
                                    <li><a href="Controllers/Op.php?option=addCart&id=<?= $row['prod_id'] ?>" class="fa fa-shopping-cart"></a></li>
                                </ul>
                                <span class="product-new-label">New</span>
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a href="#"><?= $row["prod_name"] ?></a></h3>
                                <ul class="rating">
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                </ul>
                                <div class="price">R$ <?= $row["prod_pric"] ?>
                                    <span>$20.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>