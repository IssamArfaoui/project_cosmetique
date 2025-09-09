


<?php

try {
    $connect = new PDO("mysql:host=localhost;dbname=cosmetique","root","");
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "error : ".$error->getMessage();
    exit;
}
