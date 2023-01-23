<?php
session_start();

include '../../config.php';

// response holder
$response = array();

if (!isset($_SESSION['admin'])) {
    $response['status'] = "error";
    $response['msg'] = "You are not logged in";
    echo json_encode($response);
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $img_url = "test img";

        if (!preg_match("/^[A-Z a-z]{2,30}$/", $category)) {
            $response['status'] = "error";
            $response['msg'] = "Name should contain alphabet only";
        } else {
            $sql = "INSERT INTO category VALUES (DEFAULT, '$img_url', '$category')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $response['status'] = "success";
                $response['msg'] = "Category added successfully";
            } else {
                $response['status'] = "error";
                $response['msg'] = "Failed to add category";
            }
        }

        echo json_encode($response);
    } else {
        header('location: ../../invalid.html');
    }
}
