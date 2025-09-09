<?php

require_once "../required/configue.php";

session_start();

if ($_POST) {

    $user = $_POST['user'];
    $passe = $_POST['passe'];

    $select = "SELECT * FROM `login` WHERE `user` = :user AND passe = :passe";
    $pdo = $connect ->prepare($select);
    $pdo ->execute([
        'user' => $_POST['user'],
        'passe' => $_POST['passe']
    ]);

    $count = $pdo ->rowCount();
    if ($count > 0) {
        $_SESSION['user'] = $_POST['user'];
        header('location: ShowProducts.php');
    }else {
        $message = "<div class='alert bg-danger-subtle'>User Or Passe is invalid </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<style>
    * {
        box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0; 
    }

    .login-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    .login-container h2 {
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 24px;
        color: #333333;
        text-align: center;
    }
    .input-group {
        margin-bottom: 15px;
    }
    .input-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #333333;
    }
    .input-group input[type="text"], 
    .input-group input[type="password"] {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #cccccc;
        border-radius: 4px;
        font-size: 14px;
    }
    button {
        font-family: "Montserrat", sans-serif;
        font-weight: 600;
        font-style: normal;
        -webkit-font-smoothing: antialiased;
        color: rgb(0, 0, 0);
        border: 1px solid rgb(0, 0, 0);
        background-color: transparent;
        font-size: 12px;
        letter-spacing: 3px;
        padding: 12px 20px;
        width: 100%;
        cursor: pointer;
    }
    button:hover {
        background-color: rgb(0, 0, 0);
        color: rgb(255, 255, 255);
        transition: .3s;
    }

</style>

<div class="login-container">
    <form method="post" action="">
    
        <h2>Login</h2>
        <?php
            if (isset($message)) {
                echo $message ;
            }
        ?>
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="user" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="passe" required>
        </div>
        <button type="submit">Login </button>

    </form>
</div>

</body>
</html>
