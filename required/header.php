

<?php   
    ob_start();

    session_start();

    require_once "required/configue.php";
    $select = "SELECT * FROM `panel_cart`";
    $pdo = $connect->query($select);
    $sql = $pdo->fetchAll();

    $subtotal = 0;
    foreach ($sql as $item) {
    $subtotal += $item['quantity'] * $item['prix'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    </head>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<body>

    <style>
        header img {
            width: 100px;
        }
        header small {
            font-size: 13px;
            font-weight: bold;
        }
        header #whatsapp img {
            position: fixed;
            top: 70%;
            right: 12px;
            width: 58px;
            transition: .5s;
            z-index: 1000;
        }
        header #whatsapp img:hover {
            transform: scale(1.2);
            transition: .5s;

        }
    </style>

    <header class="p-2">
        <a id="whatsapp" class="nav-link" href="https://wa.me/212155555555?text=I'd%20like%20to%20chat%20with%20you" target="_blank">
            <img class="" src="images/sociale.png" alt="">
        </a>
        <div class="container">
        <div class="position-relative">
        </div>
            <div class="d-flex align-items-center justify-content-between">
                <h3>Logo</h3>
                <div class="d-flex gap-4 align-items-center">
                   <div id="drop-menu" class="z-5">
                    <div class="d-flex">
                        <ul class=" p-0 m-0 d-flex gap-2">
                            <li class="p-2 fs-5"><a class="text-decoration-none text-black" href="index.php">Accueil</a></li>
                            <li class="p-2 fs-5"><a class="text-decoration-none text-black" href="collection.php">Collection</a></li>
                            <li class="p-2 fs-5"><a class="text-decoration-none text-black" href="products.php">Produit</a></li>
                            <li class="p-2 fs-5"><a class="text-decoration-none text-black"href="contact.php">Contact</a></li>
                            <div class="social">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="p-0 m-0 fs-5"><a class="nav-link p-2 " href="#">Fr </a></p>
                                    <div class="d-flex gap-3">
                                        <i class="fa-brands fa-tiktok"></i>
                                        <i class="fa-brands fa-whatsapp"></i>
                                        <i class="fa-brands fa-instagram"></i>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Panier d'achat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <?php if ($sql) { ?>

                    <div class="offcanvas-body">
                        <?php
                            foreach($sql as $value)  { 

                            if (isset($_POST['submit'])) {

                            $id = $_POST['id'];

                            $delete = "DELETE FROM `panel_cart` WHERE `id`= ?";
                            $supr = $connect ->prepare($delete);
                            $supr->execute([$id]);

                            header("Refresh: .6; url=");
                        }
                        
                        ?>
                        <form method="post" class="panel_cart text-secondary fs-5 d-flex align-items-center gap-2" >
                            <img src="FileImages/<?php echo $value['image'] ?>" alt="">
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <p class='m-0'><?php echo $value['title'] ?></p>
                                    <p class='m-0 price fs-6'><?php echo $value['quantity'] ?> x $<?php echo $value['prix'] ?></p> 
                                </div>
                            </div>
                            <button class="bg-transparent border-0" type="submit" name='submit'>
                                <i class="fs-4 fa-regular fa-circle-xmark d-block text-dark"></i>
                            </button>
                            <input type="hidden" name='id' value="<?php echo $value['id'] ?>">
                        </form>
                        <hr>
                        
                        <?php } ?>
                        </div>
                        <div class='offcanvas-footer p-3'>
                            <hr>
                            <p class="fs-6 price d-flex justify-content-between px-1"><span class='text-start text-dark fw-bolder'>Total : </span>$<?php echo number_format($subtotal, 2); ?></p>
                            <hr>
                            <a href="shopping.php"><button class='butn w-100 py-3'>Voir le panier</button></a>
                            <a href="checkout.php"><button class='butn w-100 mt-2 py-3'>Vérifier</button></a>
                        </div>
                        <?php
                        } else { 
                            echo "<p class='text-secondary position-absolute top-50 start-50 translate-middle-x w-100 text-center'>Aucun produit dans le panier.</p>";
                            echo "<div class='else offcanvas-footer p-3 position-absolute bottom-0 end-0 start-0'>
                            <a href='products.php'><button class='butn w-100 py-3'>Continuer les achats</button></a>
                            </div>";
                        }
                        ?>
                    </div>          
                    <i class="fa-solid fs-5 fa-magnifying-glass"></i>
                    <div class="position-relative">
                        <i class="fa-solid fs-5 fa-bag-shopping " class="btn btn-primary " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" ></i>
                        <small class="position-absolute bottom-25 text-dark pe-2 ps-2 rounded-circle translate-middle"> <?php echo $numRows = count($sql); ?></small> 
                    </div>
                    <i id="bars" class="fa-solid fa-bars fs-5"></i>
                    
               </div>
            </div>
            
        </div>
    </header>