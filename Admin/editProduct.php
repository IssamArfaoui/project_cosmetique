
<style>
    img {
        width: 100px;
    }
</style>
<?php

require_once "Require/Header.php";
require_once "../required/configue.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id']; 

    $productQuery = "SELECT * FROM products WHERE id = :id";
    $stmt = $connect->prepare($productQuery);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch();

    if (!$product) {
        echo "<p>Product not found.</p>";
        exit;
    }

    // Fetch existing images for this product
    $imageQuery = "SELECT * FROM images WHERE prd_id = :id";
    $stmt = $connect->prepare($imageQuery);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $images = $stmt->fetchAll();

    if ($_POST) {
        $name = $_POST['name'];
        $title = $_POST['title'];
        $ml = $_POST['ml'];
        $price = $_POST['prix'];
        $typeprd = $_POST['typeprd'];
        $description = $_POST['description'];

        // Update product information
        $updateProduct = "UPDATE `products` SET `name` = ?, typeprd = ?, title = ?, ml = ?, prix = ? , description = ? WHERE id = ?";
        $pdo = $connect->prepare($updateProduct);
        $pdo->execute([$name, $typeprd, $title, $ml, $price,$description, $productId]);

        // Handle image uploads (if any)
        if (!empty($_FILES['image']['name'][0])) {
            $uploadedImages = $_FILES['image'];

            // Insert new images
            for ($i = 0; $i < count($uploadedImages['name']); $i++) {
                $imageName = $uploadedImages['name'][$i];
                $tmpName = $uploadedImages['tmp_name'][$i];
                $newFile = uniqid('img_', true) . '-' . basename($imageName);

                move_uploaded_file($tmpName, '../FileImages/' . $newFile);

                // Insert image into images table
                $insertImageQuery = "INSERT INTO `images` (prd_id, images) VALUES (?, ?)";
                $pdo = $connect->prepare($insertImageQuery);
                $pdo->execute([$productId, $newFile]);
            }
        }

        // Handle image removal (if any)
        if (!empty($_POST['remove_images'])) {
            $removeImageIds = $_POST['remove_images'];
            foreach ($removeImageIds as $imageId) {
                // Fetch image details to remove from the filesystem
                $imageQuery = "SELECT * FROM images WHERE id = :id";
                $stmt = $connect->prepare($imageQuery);
                $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
                $stmt->execute();
                $image = $stmt->fetch();
                
                // Remove image file from the server
                if ($image) {
                    unlink('../FileImages/' . $image['images']);
                }

                // Remove image record from database
                $deleteImageQuery = "DELETE FROM images WHERE id = :id";
                $stmt = $connect->prepare($deleteImageQuery);
                $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        echo "<div class='alert alert-success m-2' role='alert'>
                <i class='fa-solid fa-check'></i> Product updated successfully!
            </div>";
    }
} else {
    echo "<p>Invalid product ID.</p>";
    exit;
}

?>

<h1>Update Products</h1>

<div class="form-container m-3">
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Product Form</h1>

        <label for="image">Collection Images</label>
        <input type="file" id="image" name="image[]" multiple> 

        <h3>Existing Images</h3>
        <div class="existing-images d-flex">
            <?php
            
            foreach ($images as $image) {
                echo "<div class='image-preview'>
                        <img src='../FileImages/{$image['images']}' alt='Product Image' class='img-thumbnail'>
                        <p>Existing Image</p>
                        <input type='checkbox' name='remove_images[]' value='{$image['id']}'> Remove
                    </div>";
            }
            ?>
        </div>

        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name'] ?>" placeholder="Enter product name" required>

        <label for="title">Product Title</label>
        <input type="text" id="title" name="title" value="<?php echo $product['title'] ?>" placeholder="Enter product title" required>

        <label for="price">Product Price</label>
        <input type="number" id="price" name="prix" value="<?php echo $product['prix'] ?>" placeholder="Enter product price" required>
        
        <label for="price">Description</label>
        <textarea name="description" id="description" rows="4" cols="50" required>
            <?php echo $product['description'] ?>
        </textarea>

        <label for="ml">Product Ml</label>
        <input type="number" id="ml" name="ml" value="<?php echo $product['ml'] ?>" placeholder="Enter product ml" required>
        
        <label for="typeprd">Product Type</label>
        <input type="text" id="typeprd" name="typeprd" value="<?php echo $product['typeprd'] ?>" placeholder="Enter product type" required>
        
        <button type="submit" name='submit'>Update</button>
    </form>
</div>

<?php
require_once "Require/Footer.php";
?>
