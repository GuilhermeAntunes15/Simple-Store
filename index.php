<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Site PW</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['denied'])) {
        $_SESSION['denied'] = false;
    }
    ?>
    <div class="login-dark">
        <form method="post" class="sign" action="Controllers/Op.php?option=signin">
            <h2 class=" sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>

            <?php
            if ($_SESSION['denied'] == true) {
                echo "
                <div class='form-group text-center'>Você excedeu as tentativas</div>
            ";
            }
            ?>

            <div class="form-group">
                <input class="form-control" type="email" name="txtEmail" id="txtEmail" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="txtPassword" id="txtPassword" placeholder="Password">
            </div>

            <?php
            if ($_SESSION['denied'] == false) {
                echo "
                <div class='form-group'><button class='btn btn-primary btn-block' type='submit'>Log In</button></div>
            ";
            }
            ?>
            <a class="forgot" href="#">Forgot your email or password?</a>
            <br>
            <a class="forgot" href="signup.php">Create account</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>