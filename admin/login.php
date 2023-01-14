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
                <div class="text_field">
                    <input type="text" class="no_bg no_outline" name="username" required autofocus>
                    <label>Username</label>
                </div>
                <div class="text_field">
                    <input type="password" class="no_bg no_outline" name="password" required>
                    <label>Password</label>
                </div>
                <a href="#" class="forget_password">Forgot password?</a>
                <input type="submit" class="no_outline border-curve-lg" name="login" value="login">

            </form>
        </div>
    </main>

</body>

</html>