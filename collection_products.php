<?php
require_once "required/header.php";



if (isset($_GET['collection_name'])) {

    $collectionName = htmlspecialchars($_GET['collection_name']);

    // $selectProducts = "SELECT * FROM `products` WHERE `typeprd` = :typeprd AND `is_deleted` = 0";
    $selectProducts ="
    SELECT 
        products.id, 
        products.name, 
        products.prix, 
        products.ml, 
        products.title, 
        i.images 
    FROM 
        products
    JOIN 
        images i ON products.id = i.prd_id
    WHERE 
        products.is_deleted = 0 
        AND products.typeprd = :typeprd  -- Filter by the product type (collection name)
    GROUP BY 
        products.id 
    ORDER BY 
        i.id ASC
    ";
    
    $stmt = $connect->prepare($selectProducts);
    $stmt->bindParam(':typeprd', $collectionName, PDO::PARAM_STR);

    $stmt->execute();

    $products = $stmt->fetchAll();

    } else {
        echo "<p>Aucune collection sélectionnée.</p>";
        exit;
    }
?>

<div class="background_collectionPage">

</div>
<div class="collection_prd_Pages">
    <h1 class="text-center p-5"> Collection : <?php echo $collectionName; ?></h1>
    <div class="row justify-content-center bg-secondary-subtle px-3 py-5 m-0">

    <?php
    if (!empty($products)) {
        foreach ($products as $product) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4 col">
                <div class="text-center">
                    <a class="nav-link" href="cartshopping.php?id=<?php echo $product['id'] ?>">
                        <img src="FileImages/<?php echo $product['images'] ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="my-2"><?php echo $product['name'] ?></h4>
                        </div>
                    </a>
                </div>
            </div>
        <?php }
    } else {
        echo "<p> Aucun produit trouvé dans cette collection.</p>";
    }
    ?>
    </div>
</div>

<?php require_once "required/footer.php"; ?>