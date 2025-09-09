
<?php require_once "required/header.php" ?>

    <div class="landingCollection">
        <div class="col col-12 col-lg-5 col-md-3 position-absolute top-50 start-50 translate-middle-x text-center">
            <a href="#collection" class="nav-link ">
                <button class="btn px-5 py-4 rounded-0">Notre Collection
                    <i class="fa-solid fa-arrow-down ms-1"></i>
                </button>
            </a>
        </div>
    </div>

    <div class="collectionPage">
        <h1 class="text-center title p-5">Page de collection</h1>
        <div id="collection" class="row justify-content-center gap-5 m-0 p-4">
            <?php 

            $select = "SELECT * FROM `collection` LIMIT 8"; 
            $pdo = $connect->query($select);
            $prd = $pdo->fetchAll();
            foreach($prd as $value) { ?> 

            <div class="col-lg-3 text-center col_1">
                <a class="nav-link" href="collection_products.php?collection_name=<?php echo urlencode($value['name']) ?>">
                    <img src="FileImages/<?php echo $value['image'] ?>" class="img-fluid" alt="">
                    <h4 class="my-2"><?php echo $value['name'] ?></h4>
                </a>
            </div>
        
        <?php }?>
        </div>
        
    </div>
 

<?php require_once "required/footer.php" ?>