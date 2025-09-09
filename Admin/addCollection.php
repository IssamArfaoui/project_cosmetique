


<?php
    require_once "Require/Header.php";

    require_once "../required/configue.php";

    if ($_POST) {

        $image = $_FILES['image']['name'];
        $tmpname = $_FILES['image']['tmp_name'];
        $newfile = $image;

        move_uploaded_file($tmpname , '../FileImages/' .$newfile);

        $name = $_POST['name'];       
        $ajouter = "INSERT INTO `collection`(`image`, `name`) VALUES (?,?)";
        $pdo = $connect ->prepare($ajouter);
        $pdo->execute([$newfile,$name]);
    }


    if (isset($_POST['submit'])) {
        echo "<div class='alert alert-success m-2' role='alert'>
                <i class='fa-solid fa-check'></i> Add A new Collection
            </div>";
    }



?>


<h1>Add Collection</h1>


    <div class="form-container m-3">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Collection Form</h1>

            <label for="image">Collection Image</label>
            <input type="file" id="image" name="image" required>

            <label for="name">Collection Name</label>
            <input type="text" id="name" name="name" placeholder="Enter product name" required>

            <button type="submit" name='submit'>Ajouter</button>

        </form>
    </div>



<?php
require_once "Require/Footer.php"
?>