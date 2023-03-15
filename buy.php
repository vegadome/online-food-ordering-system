<?php
session_start();
if (!isset($_SESSION['success'])) {
    echo '<script>alert("Please login first to access this page")</script>';
    header("Location: ./customer_auth/login.php");
}
require('./config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#F7922F">
    <title>Checkout | RestroHub</title>
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/responsive.css">
</head>

<body>
    <header>
        <nav class="top_nav flex items-center">
            <div class="logo__back-btn flex items-center">
                <!-- back btn -->
                <button class="nav__btn-back no_bg no_outline"><img src="./images/ic_back.svg" alt="go back"></button>
                <a href="./index.php" class="logo heading flex items-center"><img src="./images/logo.png" alt="logo">Restro
                    <span>Hub</span>
                </a>
            </div>

            <ul class="flex items-center">
                <li class="flex direction-col"><a href="menu.php">Menu</a></li>

                <!-- nav search form -->
                <?php require './components/search-form.php'; ?>

                <!-- show profile icon if the user is logged in -->
                <?php
                if (isset($_SESSION['success'])) {
                    echo '<li class="flex direction-col">
                            <img src="./images/logo.png" class="user_profile_icon" alt="account">
                            <div class="logout-dropdown border-curve shadow p-20">
                                <a href="./customer_auth/logout.php">Logout</a>   
                            </div>                         
                          </li>
                          ';
                } else {
                    echo '<li class="flex direction-col"><a href="./customer_auth/login.php"><img src="./images/ic_acc.svg" alt="account">
                    <span class="nav__tooltip shadow p-20">Login</span></a>';
                }
                ?>
        </nav>
    </header>

    <main class="checkout_page" style="margin: 0 40px 40px;">
        <button class="go_top no_bg no_outline"><img src="./images/ic_top.svg" alt="go to top"></button>

        <?php
        if (isset($_SESSION["name_error"])) {
        ?>
            <p class="error-container error p_7-20">
                <?php echo $_SESSION["name_error"]; ?>
            </p>
        <?php
            unset($_SESSION["name_error"]);
        }
        ?>

        <?php
        if (isset($_SESSION["phone_error"])) {
        ?>
            <p class="error-container error p_7-20">
                <?php echo $_SESSION["phone_error"]; ?>
            </p>
        <?php
            unset($_SESSION["phone_error"]);
        }

        if (isset($_SESSION["address_error"])) {
        ?>
            <p class="error-container error p_7-20">
                <?php echo $_SESSION["address_error"]; ?>
            </p>
        <?php
            unset($_SESSION["address_error"]);
        }
        ?>

        <?php
        if (isset($_SESSION['note_error'])) {
        ?>
            <p class="error-container error p_7-20">
                <?php echo $_SESSION['note_error']; ?>
            </p>
        <?php
            unset($_SESSION['note_error']);
        }
        ?>

        <section class="mt-20">
            <h2 class="heading">Checkout</h2>
        </section>

        <div class="checkout_table">

            <table class="mt-20">
                <tr class="shadow">
                    <th>SN</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
                <?php
                $totalPrice = 0;

                if (isset($_POST['f_id'])) {
                    $_SESSION['food_id'] = $_POST['f_id'];
                    $_SESSION['quantity'] = $_POST['quantity'];
                }

                $food_id = $_SESSION['food_id'];
                $quantity = $_SESSION['quantity'];

                $sql_food = "select * from food where f_id = $food_id";
                $res_food = mysqli_query($conn, $sql_food) or die("Could not fetch food details from database");
                $row_food = mysqli_fetch_assoc($res_food);

                $foodName = $row_food['name'];
                $foodPrice = $row_food['price'];
                $totalPrice += $foodPrice * $quantity;
                $foodImg = $row_food['img'];

                $vat = ($totalPrice * 13) / 100;
                ?>
                <tr class="shadow">
                    <td>1</td>
                    <td>
                        <img src="./uploads/foods/<?php echo $foodImg; ?>" alt="food image" class="table_food-img">
                    </td>
                    <td>
                        <?php echo $foodName; ?>
                    </td>
                    <td>
                        <div class="flex items-center justify-evenly">
                            <button class="buy_inc no_bg no_outline"><img src="./images/ic_add.svg"></button>
                            <p class="buy_page_qty"><?php echo $quantity; ?></p>
                            <button class="buy_dec no_bg no_outline"><img src="./images/ic_remove.svg"></button>
                        </div>
                    </td>
                    <td class="buy_price">
                        <?php echo $foodPrice; ?>
                    </td>
                    <td class="price_total">
                        <?php echo $foodPrice * $quantity; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mt-20 flex justify-center checkout_form_container">
            <div>
                <form action="./backend/place-order.php" method="post" class="checkout_form flex direction-col shadow border-curve p-20">
                    <label for="name">Name:*</label>
                    <input type="text" placeholder="John Sharma" name="name" class="p_7-20" id="name" required autofocus>
                    <label for="phone">Phone:*</label>
                    <input type="tel" name="phone" placeholder="9800000000" maxlength="10" class="p_7-20" id="phone" required>
                    <label for="address">Address:*</label>
                    <input type="text" name="address" placeholder="Chardobato, Banepa near check post" class="p_7-20" id="address" required>
                    <label for="note">Note:</label>
                    <input type="text" placeholder="example: with extra cheese" name="note" class="p_7-20" id="note">
                    <p style="font-weight: 700; margin-top: 10px;">Payment Method</p>
                    <div class="flex items-center justify-start payment">
                        <input type="radio" name="payment-method" id="payment-method" checked>
                        <label for="payment-method" style="white-space: nowrap; margin-left: 10px;">Cash on Delivery</label>
                    </div>
                    <input type="hidden" name="f_id" value="<?php echo $food_id; ?>">
                    <input type="hidden" name="qty" class="hidden_quantity" value="<?php echo $quantity; ?>">
                    <input type="hidden" name="total_price" value="<?php echo $totalPrice + $vat; ?>">
                    <button type="submit" name="place-order-buy" class="button mt-20 w-full border-curve">Place Order</a>
                </form>
            </div>
            <div class="direction-col justify-start ml-35 p-20 shadow border-curve checkout_details">
                <div class="checkout_info">
                    <h5 class="final_price_without_vat">Total: <?php echo $totalPrice; ?></h5>
                    <h5 class="vat">Vat (13%): <?php echo $vat; ?> </h5>
                    <h5 class="final_price">Grand Total: Rs. <?php echo $totalPrice + $vat; ?></h5>
                </div>
                <div class="mt-20 flex direction-col">
                    <a href="./menu.php" class="button mt-20 border-curve" style="background-color: #F7922F0a;">Continue Shopping</a>
                </div>
            </div>
        </div>
    </main>

    <?php require('./components/footer.php') ?>

    <script type="module" src="./js/app.js"></script>
</body>

</html>