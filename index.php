<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Are you hungry? You are at the right place. We offer mouth watering foods at your doorstep. Click now and order food online.">
    <meta name="author" content="Ashish Acharya, Bibek Mahat, Parask K. Bhandari, Suresh Dahal">
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <title>RestroHub | Order Food Online</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>

    <?php require("./components/header.php"); ?>

    <main class="main">

        <section class="hero">
            <!-- TODO: slider/banner goes here -->
        </section>

        <h1 class="heading our_special ml-auto">Our Special
            <hr class="underline ml-auto no_outline">
        </h1>

        <!-- cards container -->
        <div class="food_cards flex gap wrap justify-center">

            <?php
            include('./config.php');
            $sql = "SELECT * FROM food where special = 1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="menu_food-card border-curve shadow">
                        <!-- testing badge or something for card -->
                        <p class="card__tag text-center heading"><?php if ($data['veg'] == 0)
                                                                        echo "Veg";
                                                                    else
                                                                        echo "Non-veg"; ?></p>

                        <div class="card__food-img">
                            <img src="./uploads/foods/<?php echo $data['img']; ?>" class="food_img w-full" alt="food item">
                        </div>
                        <article class="card__food-info flex items-center">
                            <h2 class="card__food-title heading"><?php echo $data['name']; ?></h2>
                            <p class="card__food-price heading">Rs. <?php echo $data['price']; ?></p>
                        </article>
                        <!-- TODO: replace with short desc -->
                        <p class="card__food-desc">This is very delicious chinese momo full of corona virus.</p>
                        <div class="card__btns flex">
                            <a href="#" class="card__btn flex justify-center border-curve">
                                <img src="./images/ic_eye.svg" alt="view">
                            </a>
                            <a href="#" class="card__btn flex justify-center border-curve">
                                <img src="./images/ic_add-cart.svg" alt="add to cart">
                            </a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- card end -->

        <div class="button w-fit border-curve mt-20 ml-auto">
            <a href="./menu.php">View All Foods</a>
        </div>
    </main>

   <?php require("./components/footer.php"); ?>
    <script type="module" src="./js/app.js"></script>
</body>

</html>