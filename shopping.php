

<?php
    require_once "required/header.php"; 
   
?>
    <title>Shopping</title>
    <style>
        table img {
            width: 70px;
        }
        @media (min-width: 850px) {
            .card {
                width: 50%;
            }
        }
    </style>
<div class="shopping p-2 py-5">
    <h1 class="text-dark">Panier</h1>

    <?php 
    if ($sql) { 
        
    ?>
        
    <table class="table">
        <tr class="table-light">
            <th colspan=3 class="text-center text-body-tertiary">Produits</th>
            <th class="text-body-tertiary">prix</th>
            <th class="text-body-tertiary">qty</th>
            <th class="text-body-tertiary">Total</th>
        </tr> 
        <?php
            $total = 0;
            $subtotal =0;
            foreach($sql as $value) {
         ?>
        <tr>
            <td class="align-middle text-center">
                <a class="nav-link" href='required/delete.php?id=<?php echo $value['id'] ?>' >
                    <i class="delete fs-5 fa-regular fa-circle-xmark d-block text-dark"></i>
                </a>
            </td>
            <td><img src="FileImages/<?php echo $value['image'] ?>" alt=""></td>
            
            <td class="align-middle text-body-tertiary">
                <?php echo $value['title'] ?>
            </td>

            <td class="align-middle">$<?php echo $value['prix'] ?></td>
            <td class="align-middle"> x<?php echo $value['quantity'] ?></td>
            <td class="align-middle">$<?php echo  number_format(floatval($value['quantity'] * floatval($value['prix'] ))) ?></td>

        </tr>
        <?php
            $subtotal += floatval($value['quantity']) * floatval($value['prix']);
        } ?>

    </table>
    <div class="text-center text-dark">
        <div class="card">
            <div class="card-header">
                <h1 class='text-dark'>Totaux du panier</h1>
            </div>
            <div class="cadr-body p-3">
                <table class='table text-dark '>
                    <tr>
                        <th>Total </th>
                        <td>$<?php echo number_format($subtotal, 2) ?> </td>
                    </tr>
                </table>
                <a href="checkout.php" class='p-4 px-0'><button class='butn w-100 fs-6 p-3'>PASSER À LA CAISSE</button></a>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo 
        "<div class='bg-body-secondary m-2 p-2'>
        <h6 class='text-body-secondary'>Votre panier est actuellement vide.</h6>
        </div>";
        echo 
        "<a href='products.php' >
        <button class='butn w-25 fs-6 m-2 p-3'>RETOUR À LA BOUTIQUE</button>
        </a>";
    }
    ?>
</div>

<?php require_once "required/footer.php"; ?>
