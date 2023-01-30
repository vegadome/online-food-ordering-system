<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ashish Acharya, Bibek Mahat, Parask K. Bhandari, Suresh Dahal">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <title>Login | RestroHub</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <?php require("./components/header.php"); ?>

    <main class="center border-curve-lg shadow">
        <h1 class="heading text-center">Login</h1>
        <form action="./auth.php" method="post">
            <?php
            if (isset($_SESSION["username"])) {
            ?>
                <!-- to show error alert -->
                <p class="error-container p_7-20">
                    <?php echo $_SESSION["username"]; ?>
                </p>
            <?php
                unset($_SESSION["username"]);
            }
            ?>

            <?php
            if (isset($_SESSION["password"])) {
            ?>
                <!-- to show error alert -->
                <p class="error-container p_7-20">
                    <?php echo $_SESSION["password"]; ?>
                </p>
            <?php
                unset($_SESSION["password"]);
            }
            ?>

            <?php
            if (isset($_SESSION["invalid"])) {
            ?>
                <!-- to show error alert -->
                <p class="error-container p_7-20">
                    <?php echo $_SESSION["invalid"]; ?>
                </p>

            <?php
                unset($_SESSION["invalid"]);
            }
            ?>

            <div class="text_field">
                <input type="text" class="no_bg no_outline" placeholder="John Doe" name="username" required autofocus>
                <label>Username</label>
            </div>
            <div class="text_field">
                <input type="password" class="no_bg no_outline password_input" placeholder="xxxxxxxx" name="password" required>
                <label>Password</label>
                <img src="../images/ic_eye-off.svg" alt="hide password" class="pointer password_toggle_btn">
            </div>
            <a href="../customer_auth/reset/reset-password.php" class="forget_password">Forgot password?</a>
            <input type="submit" class="no_outline border-curve-lg mt-20" name="login" value="Login">

            <div class="flex items-center or justify-center mt-20">
                <siv class="bar"></siv>
                <h4>Or Continue With</h4>
                <siv class="bar"></siv>
            </div>

            <div class="flex items-center mt-20">

                <img src="../images/ic_google.svg" class="icons pointer shadow google" alt="sign in with google" id="google">

                <img src="../images/ic_facebook.svg" class="icons pointer shadow facebook" alt="sign in with facebook">

                <a href="./register.php"><img src="../images/ic_mail.svg" class="icons pointer shadow" alt="sign in with email"></a>
            </div>
        </form>
    </main>
    <script type="module" src="../js/app.js"></script>
</body>
<?php
if (isset($_COOKIE['user'])) {
    include('../../config.php');
    $signin_provider = $_COOKIE['sign_in_provider'];
    $names  = $_COOKIE['profile_name'];
    $email = $_COOKIE['email'];
    $images = $_COOKIE['image'];

    $sql_email = "SELECT email FROM customer WHERE email='$email'";
    $res_email = mysqli_query($conn, $sql_email) or die("Error");

    if (!(mysqli_num_rows($res_email) > 0)) {
        $status = "verified";
        $sql = "Insert into customer values (default,'$names',NULL,'$email',NULL,'$signin_provider','$images','$status',NULL)";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("location: ../index.php");
    } else {
        header("location: ../index.php");
    }
}
// var_dump($_COOKIE);
?>

</html>

<?php
session_unset();
?>