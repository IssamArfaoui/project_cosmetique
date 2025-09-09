<?php
    require_once "Require/Header.php";

    require_once "../required/configue.php";

    $id = $_GET['id'];

    if ($_POST) {

        $name = $_POST['name'];
        
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];
            $newfile = $image;
            move_uploaded_file($tmpname, '../FileImages/' . $newfile);

        } else {
            $image = $_POST['existing_image'];
        }

        $Update = "UPDATE `collection` SET `image`=?,`name`=? WHERE `id` = ?";
        $pdo = $connect->prepare($Update);
        $pdo->execute([$image ,$name, $id]);

        if (isset($_POST['submit'])) {
            echo "<div class='alert alert-success m-2' role='alert'>
                    <i class='fa-solid fa-check'></i> Product Updated Successfully
            </div>";
        }
    }

    $select = "SELECT * FROM `collection` WHERE `id`=?";
    $sql = $connect->prepare($select);
    $sql->execute([$id]);
    $user = $sql->fetch();
?>



<h1>Update Collection</h1>


    <div class="form-container m-3">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Collection Form</h1>

            <label for="image">Collection Image</label>
            <input type="file" id="image" name="image">
            <input type="hidden" name="existing_image" value="<?php echo $user['image']; ?>">

            <label for="name">Collection Name</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name'] ?>" placeholder="Enter product name" required>
            
            <button type="submit" name='submit'>Update</button>
        </form>
    </div>



<?php
require_once "Require/Footer.php"
?>