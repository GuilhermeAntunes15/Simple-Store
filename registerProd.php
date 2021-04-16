<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Site PW</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>


<body>
    <?php require_once "menu.php"; ?>
    <?php
    require_once "Controllers/Functions.php";
    $con = Conection();
    session_start();

    if ($_SESSION['logado'] == false) {
        header("location: index.php");
    }

    ?>
    <div class="login-dark">
        <form method="post" class="formRegister" enctype="multipart/form-data" action="Controllers/Op.php?option=registerProd">
            <div class="illustration">
                <i class="icon ion-jet"></i>
                <h2 class="">Register Product</h2>
            </div>

            <?php
            if (isset($_SESSION['erroRegister'])) {
                echo $_SESSION['msg'];
            }
            ?>

            <div class="form-group" for="txtName">
                <input class="form-control" type="name" name="txtName" id="txtName" placeholder="Name">
            </div>

            <div class="form-group" for="txtInve">
                <input class="form-control" type="number" name="txtInve" id="txtInve" placeholder="Quantity">
            </div>

            <div class="form-group" for="txtPrice">
                <input class="form-control" type="decimal" name="txtPrice" id="txtPrice" placeholder="Price">
            </div>

            <div class="form-group" for="txtRati">
                <input class="form-control" type="number" name="txtRati" id="txtRati" placeholder="Rate">
            </div>

            <div class="form-group" for="txtDescri">
                <textarea rows="4" cols="10" class="form-control" name="txtDescri" id="txtDescri" placeholder="Description"></textarea>
            </div>

            <div class="form-group" for="img1">
                <input class="form-control" type="file" name="img1" id="img1">
            </div>

            <div class="form-group" for="img2">
                <input class="form-control" type="file" name="img2" id="img2">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>