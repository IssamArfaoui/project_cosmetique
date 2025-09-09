
<?php

 require_once "../required/configue.php";

$id = $_GET['id'];

$delete = "DELETE FROM `images` WHERE `prd_id` = ?";
$sql = $connect ->prepare($delete);
$sql->execute([$id]);

header("location: ShowProducts.php");