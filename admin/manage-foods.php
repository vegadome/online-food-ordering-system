<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Foods | RestroHub</title>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../js/admin.js" defer></script>
</head>

<body>

    <?php
    require("./components/header.php");
    require("./components/sidebar.php");
    ?>

    <main class="admin_dashboard_body">

        <section class="dashboard_inner-head flex items-center">
            <h2>Manage Food Items</h2>
        </section>

        <section class="modal <?php if (isset($_SESSION['f-id']))
                                    echo "flex"; ?> items-center justify-center">
            <div class="modal_form-container border-curve-md p-20 shadow ">

                <div class="modal_title-container flex items-center">
                    <h2 class="modal-title">
                        <?php
                        if (isset($_SESSION['f-id']))
                            echo "Update Food Item";
                        else
                            echo "Add Food Item";
                        ?>
                    </h2>
                    <a href="./backend/foods/session-delete.php" class="close-icon no_bg no_outline"><img src="../images/ic_cross.svg" alt="close"></a>
                </div>

                <form action="<?php if (isset($_SESSION['f-id']))
                                    echo "./backend/foods/update.php";
                                else echo "./backend/foods/add-food.php" ?>" method="post" name="modal_form" class="form_add-food modal_form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="<?php if (isset($_SESSION['f-name']))
                                                                        echo $_SESSION['f-name'];
                                                                    else
                                                                        echo ""; ?>" id="name" autofocus required>
                        </div>

                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="price">Price:</label>
                                    <input type="number" class="w-90" name="price" value="<?php if (isset($_SESSION['f-price']))
                                                                                                echo $_SESSION['f-price'];
                                                                                            else
                                                                                                echo ""; ?>" id="price" required>
                                </div>
                                <div class="col">
                                    <label for="cost">Cost:</label>
                                    <input type="number" class="w-90" name="cost" value="<?php if (isset($_SESSION['f-cost']))
                                                                                                echo $_SESSION['f-cost']; ?>" id="cost" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label for="category">Category:</label>
                                <select name="cat_id" id="category" required>
                                    <!-- fetch categories from db -->
                                    <?php
                                    require("../config.php");

                                    $sql = "select * from category";
                                    $res = mysqli_query($conn, $sql) or die("Could not fetch categories from database");

                                    if (isset($_SESSION['f-category']))
                                        $selected_cat = $_SESSION['f-category'];
                                    else
                                        $selected_cat = "";

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $id = $row['cat_id'];
                                            $cat_name = $row['cat_name'];
                                    ?>
                                            <option value="<?php echo $id; ?>" <?php if ($selected_cat == $cat_name) echo "selected"; ?>><?php echo $cat_name; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "<option value=''>No categories found</option>";
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col">
                                <label for="image">Select an image:</label>
                                <input type="file" name="image" class="img_upload-input" id="image" required>
                            </div>
                        </div>

                        <div class="col text-center flex justify-center">
                            <div class="uploaded-img-preview">
                                <img src="<?php if (isset($_SESSION['f-img']))
                                                echo "../uploads/foods/" . $_SESSION['f-img'];
                                            else echo '../images/ic_cloud.svg'; ?>" class="upload-img" alt="uploaded image">
                            </div>
                            <p class="warning">Image should be less than 200 KB</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="estimated-cooking-time">Estimated Cooking Time:</label>
                            <input type="number" placeholder="in minutes" name="estimated-cooking-time" value="<?php if (isset($_SESSION['f-cooking-time']))
                                                                                                                    echo $_SESSION['f-cooking-time']; ?>" id="estimated-cooking-time" required>
                        </div>

                        <div class="col">
                            <label for="product-id">Product Id:</label>
                            <input type="text" name="product-id" value="<?php if (isset($_SESSION['f-product-id']))
                                                                            echo $_SESSION['f-product-id']; ?>" id="product-id" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="short-desc">Short Description: </label>
                            <textarea name="short-desc" id="short-desc" rows="3" required><?php if (isset($_SESSION['f-short-desc']))
                                                                                                echo $_SESSION['f-short-desc']; ?></textarea>
                        </div>
                        <div class="col">
                            <label for="ingredients">ingredients: </label>
                            <textarea name="ingredients" id="ingredients" rows="3" required><?php
                                                                                            // TODO: fix this
                                                                                           
                                                                                            if (isset($_SESSION['f-ingredients'])) {
                                                                                                $id  = $_SESSION['f-id'];
                                                                                                $sqli = "select ingredients from food where f_id = $id";
                                                                                                $res = mysqli_query($conn, $sqli) or die("Could not fetch ingredients from database");
                                                                                                $row = mysqli_fetch_assoc($res);
                                                                                                echo $ingredients = $row['ingredients'];     
                                                                                                //thalako sabi input type lai hata uune
                                                                                                // id set vako xa vane tehe id vata cahi data haru fetch garea form ma deka                                                                //   
                                                                                            } ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="description">Description: </label>
                            <textarea name="description" id="description" rows="5" required><?php if (isset($_SESSION['f-description']))
                                                                                                echo $_SESSION['f-description']; ?></textarea>
                        </div>

                        <div class="col">
                            <div class="col">
                                <label for="veg-non-veg">Veg or Non-veg: </label>
                                <select name="veg-non-veg" id="veg-non-veg" required>
                                    <?php
                                    $isVeg = false;
                                    if (isset($_SESSION['veg'])) {
                                        if ($_SESSION['veg'] == 0) {
                                            $isVeg = false;
                                        } else {
                                            $isVeg = true;
                                        }
                                    }
                                    ?>
                                    <option value="">Select one</option>
                                    <option value="veg" <?php if ($isVeg)
                                                            echo "selected"; ?>>Veg</option>
                                    <option value="non-veg" <?php if (!$isVeg)
                                                                echo "selected"; ?>>Non-veg</option>
                                </select>
                            </div>

                            <?php
                            if (isset($_SESSION['f-id'])) {
                                echo "<input type='hidden' name='f-id' value='" . $_SESSION['f-id'] . "'>";
                            }
                            ?>

                            <div class="col">
                                <button type="submit" class="button modal_form-submit-btn" name="<?php if (isset($_SESSION['f-id']))
                                                                                                        echo "update";
                                                                                                    else
                                                                                                        echo "add"; ?>"><?php if (isset($_SESSION['f-id']))
                                                                                                                            echo "Update";
                                                                                                                        else echo "Add" ?> Food Item</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </section>

        <div class="flex items-center">
            <!-- buttons for food management -->
            <div class="flex items-center">

                <!-- search form for employee -->
                <form action="#" method="post" class="search_form border-curve-lg">
                    <div class="flex items-center">
                        <input type="search" placeholder="Search..." class="no_outline search_employee" name="search-employee" id="search-employee">
                        <button type="submit" class="no_bg no_outline"><img src="../images/ic_search.svg" alt="search icon"></button>
                    </div>
                </form>
                <!-- 
                        // popper-btn class listenes for click event and opens modal popup
                        // controlled from admin.js
                    -->
                <button class="button ml-35 border-curve-lg popper-btn">Add Food</button>

                <?php
                $sql = "SELECT * FROM food";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                $sql_enabled = "SELECT * FROM food where disabled = 0";
                $result_enabled = mysqli_query($conn, $sql_enabled);
                $count_enabled = mysqli_num_rows($result_enabled);

                $sql_disabled = "SELECT * FROM food where disabled = 1";
                $result_disabled = mysqli_query($conn, $sql_disabled);
                $count_disabled = mysqli_num_rows($result_disabled);

                $sql_special = "SELECT * FROM food where special = 1";
                $result_special = mysqli_query($conn, $sql_special);
                $count_special = mysqli_num_rows($result_special);
                ?>

                <form action="./backend/foods/specific-food.php" method="post">
                    <input type="hidden" name="filter-by" value="all">
                    <button type="submit" name="specific-food" class="button ml-35 border-curve-lg relative">All
                        <div class="count-top shadow"><?php
                                                        echo $count;
                                                        ?>
                        </div>
                    </button>
                </form>

                <form action="./backend/foods/specific-food.php" method="post">
                    <input type="hidden" name="filter-by" value="enabled">
                    <button type="submit" name="specific-food" class="button ml-35 border-curve-lg relative">Enabled
                        <div class="count-top shadow"><?php
                                                        echo $count_enabled;
                                                        ?>
                        </div>
                </form>

                <form action="./backend/foods/specific-food.php" method="post">
                    <input type="hidden" name="filter-by" value="disabled">
                    <button type="submit" name="specific-food" class="button ml-35 border-curve-lg relative">Disabled
                        <div class="count-top shadow"><?php
                                                        echo $count_disabled;
                                                        ?>
                        </div>
                    </button>
                </form>

                <form action="./backend/foods/specific-food.php" method="post">
                    <input type="hidden" name="filter-by" value="special">
                    <button type="submit" name="specific-food" class="button ml-35 border-curve-lg relative">Special
                        <div class="count-top shadow"><?php
                                                        echo $count_special;
                                                        ?>
                        </div>
                    </button>
                </form>
            </div>
            <!-- TODO: make filter here -->
            <div class="filter flex items-center">
                <form action="#" method="post" class="filter-form">
                    <select name="cat-filter" class="p_7-20 border-curve pointer" id="cat-filter">
                        <option value="name" class="pointer">Sort by name</option>
                        <option value="expensive" class="pointer">Expensive first</option>
                        <option value="cheap" class="pointer">Cheapest first</option>
                        <option value="most-selling" class="pointer">Most selling</option>
                        <option value="least-selling" class="pointer">Least selling</option>
                        <option value="last-added" class="pointer" selected>Last added</option>
                        <option value="first-added" class="pointer">First added</option>
                    </select>
                </form>
                <img src="../images/ic_calender.svg" class="filter_by_date popper-btn" alt="filter">
            </div>
        </div>

        <?php

        // filter content by sessions
        if (isset($_SESSION['filter-by'])) {
            $filter_by = $_SESSION['filter-by'];
            unset($_SESSION['filter-by']);
            if ($filter_by == 'all') {
                $sql = "SELECT * FROM food";
            } else if ($filter_by == 'enabled') {
                $sql = "SELECT * FROM food where disabled = 0";
            } else if ($filter_by == 'disabled') {
                $sql = "SELECT * FROM food where disabled = 1";
            } else if ($filter_by == 'special') {
                $sql = "SELECT * FROM food where special = 1";
            }
        } else {
            $sql = "SELECT * FROM food order by f_id desc";
        }

        $res = mysqli_query($conn, $sql) or die("Could not fetch food items from database");
        $data1 =  mysqli_fetch_assoc($res);


        if (isset($_SESSION['delete_success'])) {
        ?>
            <!-- to show error alert -->
            <p class="error-container success p_7-20">
                <?php
                echo $_SESSION['delete_success'];
                unset($_SESSION['delete_success']);
                ?>
            </p>
        <?php
        }
        if (isset($_SESSION['delete_error'])) {
        ?>
            <p class="error-container error p_7-20">
                <?php
                echo $_SESSION['delete_error'];
                unset($_SESSION['delete_error']);
                ?>
            </p>
        <?php
        }
        if (isset($_SESSION['disable_success'])) {
        ?>
            <p class="error-container success p_7-20">
                <?php
                echo $_SESSION['disable_success'];
                unset($_SESSION['disable_success']);
                ?>
            </p>
        <?php
        }
        if (isset($_SESSION['disable_error'])) {
        ?>
            <p class="error-container error p_7-20">
                <?php
                echo $_SESSION['disable_error'];
                unset($_SESSION['disable_error']);
                ?>
            </p>
        <?php
        }
        if (mysqli_num_rows($res) > 0) {
        ?>
            <table class="mt-20">
                <tr class="shadow">
                    <th>SN</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Cost</th>
                    <th>Category</th>
                    <th>Sold</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $i++;

                    // fetch category name
                    $cat_id = $row['category'];
                    $sql_cat = "select cat_name from category where cat_id = $cat_id";
                    $res_cat = mysqli_query($conn, $sql_cat) or die("Could not fetch category name from database");
                    $row_cat = mysqli_fetch_assoc($res_cat);
                    $cat_name = $row_cat['cat_name'];
                ?>
                    <tr class="shadow">
                        <td><?php echo $i;?></td>
                        <td>
                                    
                            <img src="../uploads/foods/<?php echo $row['img']; ?>" alt="food image" class="table_food-img">
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['cost']; ?></td>
                        <td><?php echo $cat_name; ?></td>
                        <td><?php echo 125; ?></td>
                        <td class="table_action_container">
                            <!-- action menu -->
                            <button class="no_bg no_outline table_option-menu">
                                <img src="../images/ic_options.svg" alt="options menu">
                            </button>
                            <!-- options -->
                            <div class="table_action_options shadow border-curve long r_80 p-20 flex direction-col">
                                <div>
                                    <form action="./backend/foods/edit.php" method="post" class="flex items-center justify-start">
                                        <input type="hidden" name="id" value="<?php echo $row["f_id"]; ?>">
                                        <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                                        <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
                                        <input type="hidden" name="cost" value="<?php echo $row["cost"]; ?>">
                                        <input type="hidden" name="category" value="<?php echo $row["category"]; ?>">
                                        <input type="hidden" name="img" value="<?php echo $row["img"]; ?>">
                                        <input type="hidden" name="cooking-time" value="<?php echo $row["cooking_time"]; ?>">
                                        <input type="hidden" name="product-id" value="<?php echo $row["product_id"]; ?>">
                                        <input type="hidden" name="desc" value="<?php echo $row["description"]; ?>">
                                        <input type="hidden" name="short-desc" value="<?php echo $row["short_desc"]; ?>">
                                        <input type="hidden" name="ingredients" value="<?php echo $row["ingredients"]; ?>">
                                        <input type="hidden" name="veg" value="<?php echo $row["veg"]; ?>">
                                        <button type="submit" name="edit" class="no_bg no_outline">
                                            <div class="flex items-center justify-start">
                                                <img src="../images/ic_edit.svg" alt="edit icon">
                                                <p>Edit</p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <a href="#">
                                        <div class="flex items-center justify-start">
                                            <img src="../images/ic_view.svg" alt="view icon">
                                            <p>View</p>
                                        </div>
                                    </a>
                                </div>
                                <!-- add to special food -->
                                <div>
                                    <form action="./backend/foods/<?php
                                                                    if ($row['special'] == 0)
                                                                        echo "add-to-special";
                                                                    else
                                                                        echo "remove-from-special";
                                                                    ?>.php" method="post" class="flex items-center justify-start">
                                        <input type="hidden" name="id" value="<?php echo $row["f_id"]; ?>">
                                        <button type="submit" name="add-to-special" class="no_bg no_outline">
                                            <div class="flex items-center justify-start">
                                                <img src="../images/<?php
                                                                    if ($row['special'] == 0)
                                                                        echo "ic_add.svg";
                                                                    else
                                                                        echo "ic_remove.svg";
                                                                    ?>" alt="toggle special food">
                                                <p>
                                                    <?php
                                                    if ($row['special'] == 0)
                                                        echo "Add to special";
                                                    else
                                                        echo "Remove special";
                                                    ?>
                                                </p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <form action="./backend/foods/delete.php" method="post" class="flex items-center justify-start">
                                        <input type="hidden" name="id" value="<?php echo $row["f_id"]; ?>">
                                        <input type="hidden" name="img" value="<?php echo $row["img"]; ?>">
                                        <button type="submit" name="delete" class="no_bg no_outline delete_btn">
                                            <div class="flex items-center justify-start">
                                                <img src="../images/ic_delete.svg" alt="delete icon">
                                                <p>Delete</p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <form action="./backend/foods/<?php if ($row['disabled'] == 0)
                                                                        echo "disable";
                                                                    else
                                                                        echo "enable"; ?>.php" method="post" class="flex items-center justify-start">
                                        <input type="hidden" name="id" value="<?php echo $row["f_id"]; ?>">
                                        <button type="submit" name="disable" class="no_bg no_outline">
                                            <div class="flex items-center justify-start">
                                                <img src="../images/<?php if ($row['disabled'] == 0)
                                                                        echo "ic_disable.svg";
                                                                    else
                                                                        echo "ic_enable.svg"; ?>" alt="enable disable icon">
                                                <p>
                                                    <?php
                                                    if ($row['disabled'] == 0)
                                                        echo "Disable";
                                                    else
                                                        echo "Enable";
                                                    ?>
                                                </p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        } else
            echo "No records found";
        ?>
    </main>

</body>

</html>