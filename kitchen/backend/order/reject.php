<?php
session_start();
require('../../../config.php');

// TODO: replace this with the kitchen-success session
if (!isset($_SESSION['admin-success'])) {
    header('location: ../../../invalid.html');
} else {
    if (isset($_POST['reject'])) {

        $order_id = mysqli_real_escape_string($conn, $_POST['id']);
        $kos_id = mysqli_real_escape_string($conn, $_POST['kos_id']);

        // TODO: notify admin that the order has been rejected by the kitchen
        $sql = "UPDATE kos SET status = 'rejected' WHERE order_id = {$order_id} and kos_id = {$kos_id}";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($result) {
            $_SESSION['order-success'] = "Order rejected successfully";
            header('location: ../../index.php');
        } else {
            $_SESSION['order-error'] = "Something went wrong. Please try again";
            header('location: ../../index.php');
        }
    } else {
        header('location: ../../../invalid.html');
    }
}