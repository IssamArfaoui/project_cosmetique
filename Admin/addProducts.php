<?php
require_once "Require/Header.php";
require_once "../required/configue.php";

if ($_POST) {

    $name = $_POST['name'];
    $title = $_POST['title'];
    $ml = $_POST['ml'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $typeprd = $_POST['typeprd'];

    $ajouter = "INSERT INTO `products` (`name`, typeprd, title, ml, prix ,`description`) 
                VALUES (?, ?, ?, ?, ?, ?)";

    $pdo = $connect->prepare($ajouter);
    $pdo->execute([$name, $typeprd, $title, $ml, $price, $description]);

    $productId = $connect->lastInsertId();

    // Check if images were uploaded
    if (!empty($_FILES['image']['name'][0])) {
        $uploadedImages = $_FILES['image']; 

        for ($i = 0; $i < count($uploadedImages['name']); $i++) {
            if (!empty($uploadedImages['name'][$i])) { // Only process if the image is not empty

                $imageName = $uploadedImages['name'][$i];
                $tmpName = $uploadedImages['tmp_name'][$i];
                $newFile = uniqid('img_', true) . '-' . basename($imageName); 

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($tmpName, '../FileImages/' . $newFile)) {

                    // Insert the image into the database
                    $insertImageQuery = "INSERT INTO `images` (prd_id, images) VALUES (?, ?)";
                    $pdo = $connect->prepare($insertImageQuery);
                    $pdo->execute([$productId, $newFile]);
                }
            }
        }
        echo "<div class='alert alert-success m-2' role='alert'>
                <i class='fa-solid fa-check'></i> Product and images added successfully!
            </div>";
    } else {
        // If no image files are uploaded
        echo "<div class='alert alert-warning m-2' role='alert'>
                <i class='fa-solid fa-exclamation-circle'></i> No images uploaded. Please upload at least one image.
            </div>";
    }
}
?>

<h1>Add Product</h1>

<div class="form-container m-3">
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Product Form</h1>

        <label for="image">Collection Images (You can select multiple images)</label>
        <input type="file" id="image" name="image[]" multiple required> 

        <!-- Optionally you can include specific image slots but keep in mind they should not be empty -->
        <div class="d-flex">
            <div>
                <label for="image">Images-1</label>
                <input type="file" id="image" name="image[]" > 
            </div>
            <div>
                <label for="image">Images-2</label>
                <input type="file" id="image" name="image[]" > 
            </div>
        </div>
        <div class="d-flex">
            <div>
                <label for="image">Images-3</label>
                <input type="file" id="image" name="image[]" > 
            </div>
        </div>

        <label for="title">Product Name</label>
        <input type="text" id="title" name="name" placeholder="Enter product title" required>
        
        <label for="title">Product Title</label>
        <input type="text" id="title" name="title" placeholder="Enter product title" required>

        <label for="price">Product Price</label>
        <input type="number" id="price" name="price" step="0.01"  placeholder="Enter product price" required>
        
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4" cols="50" required></textarea>
        
        <label for="ml">Product Ml</label>
        <input type="number" id="ml" name="ml" placeholder="Enter product ml" required>

        <label for="typeprd">Product Type</label>
        <input type="text" id="typeprd" name="typeprd" placeholder="Enter product type" required>


        <button type="submit" name="submit">Add Product</button>
    </form>
</div>

<?php
require_once "Require/Footer.php";
?>
