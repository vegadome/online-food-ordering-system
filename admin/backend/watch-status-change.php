<?php
session_start();
require("../../config.php");
if (isset($_SESSION['admin-success'])) {
    $sql = "Select * from kos";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    $response = array();

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
           
            $sql_fetch_food = "select food.name from orders inner join food on orders.f_id = food.f_id where orders.id = {$row['order_id']}";
            $res_fetch_food = mysqli_query($conn, $sql_fetch_food) or die(mysqli_error($conn));
            $food_name = mysqli_fetch_assoc($res_fetch_food)['name'];

            $row['food_name'] = $food_name;
            $response[] = $row;
        }
        echo json_encode($response);
    }
} else {
    header('location: ../../invalid.html');
}
