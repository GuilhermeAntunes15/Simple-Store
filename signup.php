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
    <?php session_start(); ?>
    <div class="login-dark">
        <form method="post" class="sign" action="Controllers/Op.php?option=signup">
            <h2 class="sr-only">SignUp Form</h2>
            <div class="illustration">
                <i class="icon ion-ios-locked-outline"></i>
            </div>

            <?php
            if (isset($_SESSION['erroRegister'])) {
                if ($_SESSION['erroRegister'] == 1) {
                    echo $_SESSION['msg'];
                }
            }
            ?>

            <div class="form-group" for="name">
                <input class="form-control" type="name" name="txtName" id="txtName" placeholder="Name">
            </div>

            <div class="form-group" for="nascimento">
                <input class="form-control" type="date" name="txtNascimento" id="txtNascimento" placeholder="Data de Nascimento">
            </div>

            <div class="form-group" for="email">
                <input class="form-control" type="email" name="txtEmail" id="txtEmail" placeholder="Email">
            </div>

            <div class="form-group" for="CPF">
                <input class="form-control" type="CPF" name="txtCPF" id="txtCPF" placeholder="CPF">
            </div>

            <div class="form-group" for="pass">
                <input class="form-control" type="password" name="txtPassword" id="txtPassword" placeholder="Password">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>