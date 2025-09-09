

<style>
    img {
        width: 100%;
        cursor: pointer;
    }

    .main-image-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .main-image-container img {
        width: 400px; 
        border: 2px solid #ddd;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
        border: none;
    }

    .thumbnails-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .thumbnails-container img {
        width: 80px;
        opacity: 0.7;
        border-radius: 5px;
        transition: opacity 0.3s ease-in-out;
        border: 2px solid #ccc;
    }

    .thumbnails-container img:hover {
        opacity: 1;
    }

    .thumbnails-container img.selected {
        border-color: black;
        opacity: 1;
    }

    .product-info {
        padding-left: 20px;
    }
</style>
<?php
require_once "required/header.php";



$id = $_GET['id'];


$select = "SELECT 
            products.id, 
            products.name, 
            products.prix, 
            products.ml, 
            products.title, 
            products.description, 
            i.images 
            FROM products 
            JOIN images i ON products.id = i.prd_id 
            WHERE products.id = ? AND products.is_deleted = 0";

$sql = $connect->prepare($select);
$sql->bindParam(1, $id, PDO::PARAM_INT);
$sql->execute();
$product = $sql->fetch();

if (isset($_POST['submit'])) {

    header("location: cartshopping.php?id=" . $product['id']);
    ob_end_flush();
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $image = $_POST['image'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $prix = $_POST['prix'];
    $quantity = $_POST['quantity'];

    
    $checkQuery = "SELECT * FROM `panel_cart` WHERE `title` = ? AND `name` = ?";
    $checkStmt = $connect->prepare($checkQuery);
    $checkStmt->execute([$title, $name]);
    $existingProduct = $checkStmt->fetch();

    if ($existingProduct) {
        
        $newQuantity = $existingProduct['quantity'] + $quantity;
        $updateQuery = "UPDATE `panel_cart` SET `quantity` = ? WHERE `id` = ?";
        $updateStmt = $connect->prepare($updateQuery);
        $updateStmt->execute([$newQuantity, $existingProduct['id']]);
    } else {

        $insertQuery = "INSERT INTO `panel_cart` (`image`, `name`, `title`, `prix`, `quantity`) 
                        VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $connect->prepare($insertQuery);
        $insertStmt->execute([$image, $name, $title, $prix, $quantity]);
    }

    
    header("Location: cartshopping.php?id=" . $product['id']);
    exit;
}

?>

<title>Product Details - Cart</title>

<div class="container cart_shopping">
    <form action="cartshopping.php?id=<?php echo $product['id']; ?>" method="post" class="cart p-4">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-5 col-12 col_1">
                <div class="image-slider">
                    <?php 

                    $imageQuery = "SELECT images FROM images WHERE prd_id = ?";
                    $imageStmt = $connect->prepare($imageQuery);
                    $imageStmt->execute([$product['id']]);
                    $images = $imageStmt->fetchAll();

                    if ($images) {
                    ?>
                    <div class="main-image-container">
                        <img id="mainImage" src="FileImages/<?php echo $images[0]['images']; ?>" alt="Main Product Image" class="img-fluid">
                    </div>
                    <div class="thumbnails-container">
                        <?php foreach ($images as $index => $img) { ?>
                            <img class="thumbnail" src="FileImages/<?php echo $img['images']; ?>" alt="Thumbnail Image" onclick="changeImage(this)">
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <div class="col-xl-6 col-lg-5 col-12 col_2">
                <div class="text p-5 px-3">
                    <h5 class="pt-2"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
                    <h4 class="pt-1"><?php echo htmlspecialchars($product['title']); ?></h4>
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($product['title']); ?>">
                    <h3 class="pt-1 text-secondary">$<?php echo htmlspecialchars($product['prix']); ?><span> & Livraison gratuite</span></h3>
                    <input type="hidden" name="prix" value="<?php echo htmlspecialchars($product['prix']); ?>">
                    <input type="hidden" name="image" value="<?php echo $images[0]['images']; ?>">
                    <label for="quantity"><h4>Quantity : </h4></label>
                    <input type="number" name="quantity" id="quantity" class="text-center" min="1" max="20" value="1">
                    <br>
                    <button type="submit" name="submit" class="butn py-2 px-5 mt-3">Ajouter au panier</button>

                    <hr>

                    <label for="">Description:</label>
                    <p><?php echo $product['description'] ?></p>
                </div>
            </div>               
        </div>
    </form>
</div>

<div class="product p-5 related_product">
        <h1 class="text-dark text-center">Produits Connexes</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 m-2 ms-0 me-0 justify-content-center ">
            <?php
            
            $select = "SELECT 
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
        GROUP BY 
            products.id 
        ORDER BY 
          RAND() ,i.id ASC 
        LIMIT 2 "; 
            $pdo = $connect ->query($select);
            $user = $pdo->fetchAll();

            foreach($user as $list) { ?>  
            <div class="col-6 col-md-3 col-lg-3 text-center">
                <div class="popular text-center">
                    <div class="select">
                        <a href="cartshopping.php?id=<?php echo $list['id'] ?>" class="cadr">
                            <img src="FileImages/<?php echo $list['images'] ?>" class=" w-75 card-img-top" alt="">
                        </a>
                        
                        <div class="bag_shopping">
                            <a href="cartshopping.php?id=<?php echo $list['id'] ?>"></a>
                        </div>
                        
                    </div>
                    <div class="text">
                        <a class="nav-link" href="cartshopping.php?id=<?php echo $list['id'] ?>" class="m-1"><h5 class="py-3"><?php echo $product['name'] ?></h5></a>
                    </div>
                </div>
            </div>        
            <?php } ?>
        </div>
</div>


<?php require_once "required/footer.php"; ?>





