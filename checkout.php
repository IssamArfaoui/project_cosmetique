<?php require_once "required/header.php"; ?>

<title>Checkout</title>

<style>
    .row input:focus, .row textarea:focus {
        outline: none;
        box-shadow: none;
        border: 1px solid black;
    }
    table img {
        width: 45px;
    }
</style>

<?php

if ($_POST) {

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $images = $_POST['hd_image'];
    $titles = $_POST['hd_title']; 
    $prices = $_POST['hd_prix']; 
    $quantities = $_POST['hd_quantity'];  

    // Check if the arrays match in length
    if (count($images) == count($titles) && count($titles) == count($prices) && count($prices) == count($quantities)) {

        // Prepare the SQL Insert statement
        $insert = "INSERT INTO `orders` (`name`, `email`, `number`, `address`, `images`, `title`, `prix`, `quantity`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $sql = $connect->prepare($insert);

        // Loop through each product and insert order details
        foreach ($titles as $i => $title) {
            $sql->execute([
                $name, 
                $email, 
                $phone, 
                $address, 
                $images[$i], 
                $title, 
                $prices[$i], 
                $quantities[$i]
            ]);
        }

        $delete = "DELETE FROM `panel_cart`";
        $supr = $connect->prepare($delete);
        $supr->execute();

        header('Location: confirmed.php');
        exit; 
    } else {
        echo "<div class='alert alert-danger'>Error: Data mismatch in arrays!</div>";
    }
}

?>

<div class="container checkout mt-5 p-5">
    <h1 class="text-dark mb-4">VÉRIFIER</h1>

    <form method="POST" class="row">
        <div class="col-lg-7">
            <div class="form-group d-flex justify-content-between gap-3">
                <input type="text" class="form-control w-50 rounded-0 p-3 my-3" name="name" placeholder="Entrez votre nom" required>
                <input type="tel" class="form-control rounded-0 w-50 my-3" name="phone" placeholder="Entrez votre téléphone" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control rounded-0 p-3 my-3" name="email" placeholder="Entrez votre email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control rounded-0 p-3 my-3" name="address" placeholder="Entrez votre adresse" required>
            </div>
            <button type="submit" class="fs-6 p-3 butn text-center my-2 px-5" name="submit">PASSER LA COMMANDE</button>
        </div>

        <div class="col-lg-5 card p-0">
            <div class="card-header">
                <h1 class="text-dark text-center">Vos Commandes</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th colspan="4" class="text-body-tertiary">Produits</th>
                        <th class="text-body-tertiary">Total</th>
                    </tr>
                    <?php

                    $select = "SELECT * FROM `panel_cart`";
                    $pdo = $connect->query($select);
                    $user = $pdo->fetchAll();
                    $subtotal = 0;

                    foreach ($user as $order) {
                    ?>
                        <tr>
                            <input type="hidden" name="hd_image[]" value="<?php echo $order['image']; ?>">
                            <input type="hidden" name="hd_title[]" value="<?php echo $order['title']; ?>">
                            <input type="hidden" name="hd_prix[]" value="<?php echo $order['prix']; ?>">
                            <input type="hidden" name="hd_quantity[]" value="<?php echo $order['quantity']; ?>">

                            <td class="align-middle"><img src="FileImages/<?php echo $order['image']; ?>" alt=""></td>
                            <td class="align-middle text-body-tertiary">
                                <?php echo $order['title']; ?>
                            </td>
                            <td class="align-middle">$<?php echo number_format($order['prix'], 2); ?></td>
                            <td class="align-middle">x<?php echo $order['quantity']; ?></td>
                            <td class="align-middle">$<?php echo number_format(floatval($order['quantity']) * floatval($order['prix']), 2); ?></td>
                        </tr>
                    <?php
                        // Calculate the subtotal
                        $subtotal += floatval($order['quantity']) * floatval($order['prix']);
                    }
                    ?>
                </table>
            </div>
            <div class="card-footer">
                <p class="d-flex justify-content-end ms-2 me-2 fs-5 fw-bolder"> $ <?php echo number_format($subtotal, 2); ?></p>
            </div>
        </div>
    </form>
</div>


<?php require_once "required/footer.php"; ?>
