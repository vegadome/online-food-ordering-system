<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ashish Acharya, Bibek Mahat, Parask K. Bhandari, Suresh Dahal">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <title>Admin Login | RestroHub</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <main class=" flex direction-col h-100 border-curve-lg shadow">
        <div class="center shadow border-curve-md">
            <h1 class="heading text-center">Admin Login</h1>
     
            <form action="./auth.php" method="post">      
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <!-- to show error alert -->
                <p class="error-container p_7-20">
                    <?php echo $_SESSION['username']; ?>
                </p>
                
            <?php
                unset($_SESSION['username']);
            }
            ?>

          <?php
            if (isset($_SESSION['password'])) {
            ?>
                <!-- to show error alert -->
                <p class="error-container p_7-20">
                    <?php echo $_SESSION['password']; ?>
                </p>
                
            <?php
                unset($_SESSION['password']);
            }
            ?>
                
                <div class="text_field">
                    <input type="text" class="no_bg no_outline" placeholder="John Doe" name="username" required autofocus>
                    <label>Username</label>
                </div>
                <div class="text_field">
                    <input type="password" class="no_bg no_outline" placeholder="xxxxxxxx" name="password" required>
                    <label>Password</label>
                </div>
                <a href="./reset/reset-password.php" class="forget_password">Forgot password?</a>
                <input type="submit" class="no_outline border-curve-lg mt-20" name="login" value="Login">

            </form>
        </div>
    </main>
<script src="../js/admin.js"></script>
</body>

</html>

<?php
// session_unset();
?>