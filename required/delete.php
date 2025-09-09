
<?php

require_once "configue.php";

    $id = $_GET['id'];

    $delete = "DELETE FROM `panel_cart` WHERE `id`= ?";
    $sql = $connect ->prepare($delete);
    $sql->execute([$id]);

    header('location: ../shopping.php');