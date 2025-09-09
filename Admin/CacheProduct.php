


<?php

require_once "../required/configue.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $update = "UPDATE `products` SET `is_deleted`= 1 WHERE `id` = ?";
    $sql = $connect->prepare($update);
    $sql->execute([$id]);

    header("location: ShowProducts.php");
}