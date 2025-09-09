

    <?php require_once "required/header.php" ?>

    <div class="landing">
        <div class="text py-5 d-flex justify-content-end">  
            <div class="content m-0 pt-2">
                <div class="">
                    <div class="d-flex justify-content-center ">
                        <h4 class="text-center p-3 px-4 rounded-5">Libérez votre éclat avec <span class="text-success">PRO</span> <span>FILANOR</span></h4>
                    </div>
                    <div class="p-2 ">
                        <h1 class="">Tous nos produits sont
                            <p>inspirés de la nature 100%</p>
                        </h1>
                        <p class="pe-5 fw-bold Améliorez">Améliorez votre routine de soins capillaires et cutanés et libérez votre éclat intérieur.
                            Adoptez la beauté de cheveux sains et magnifiques et d'une peau éclatante qui fait
                            tourner toutes les têtes, car vous méritez de vous sentir fabuleuse chaque jour !
                        </p>
                    </div>
                </div>
                <div class="position-relative p-3 py-5 row gap-3 m-0 justify-content-between text-center">
                    <div class="col col-12 col-lg-5 col-md-3"><a href="products.php" class="nav-link"><button class="btn  px-4 py-3 rounded-0 ">Achetez maintenant<i class="fa-solid fa-arrow-right ms-1"></i></button></a></div>
                    <div class="col col-12 col-lg-5 col-md-3"><a href="collection.php" class="nav-link"><button class="btn btn-2 px-4 py-3 rounded-0">Notre Collection</button></a></div>
                    <hr class="position-absolute top-50 start-50 translate-middle-x border-3 d-none d-sm-block">
                </div>
            </div>
        </div>
    </div>
    <div class="banner py-2">
        <div class="banner-content ">
            <div class="promotion text-body-tertiary">Stock limité, achetez maintenant</div>
            <div class="promotion">Économisez jusqu'à 50 %</div>
            <div class="promotion">Un nouveau produit, chaque jour</div>
            <div class="promotion text-body-tertiary">Offres spéciales à venir cette semaine</div>
            
            <div class="promotion text-body-tertiary">Stock limité, achetez maintenant</div>
            <div class="promotion">Économisez jusqu'à 50 %</div>
            <div class="promotion">Un nouveau produit, chaque jour</div>
            <div class="promotion text-body-tertiary">Offres spéciales à venir cette semaine</div>
        </div>
    </div>

    <div class="collection bg-body-secondary py-4">
        <div class="d-flex align-items-center justify-content-center px-3">
            <div class="bar-grad">
                <span></span>
                <span class="w-50"></span>
            </div>
            <h1 class="text-center p-5 title">Découvrez notre collection</h1>
            <div class="bar-grad">
                <span class="w-50"></span>
                <span></span>
            </div>
        </div>
        <div class="slider-container py-5">
            <div class="slider" id="slider">
                <?php 

                $select = "SELECT * FROM `collection`  LIMIT 4"; 
                $pdo = $connect->query($select);
                $prd = $pdo->fetchAll();

                foreach($prd as $value) {  ?> 

                    <div class="card bg-transparent text-center">
                        <a class="nav-link" href="collection.php">
                            <img src="FileImages/<?php echo $value['image'] ?>" class="img-fluid w-100" alt="">
                            <h6 class="p-2 fw-bold"><?php echo $value['name'] ?></h6>
                        </a>
                    </div>
                    
                <?php }?>
            </div>
        </div>
        <div class="button-container" style="opacity:1">
            <button class="arrow-button" id="prev"><i class="fa-solid fa-arrow-left fs-2 bg-white rounded-5 p-3"></i></button>
            <button class="arrow-button" id="next"><i class="fa-solid fa-arrow-right fs-2 bg-white rounded-5 p-3 bg-danger"></i></button>
        </div>
        
    </div>
    <div class="nosproducts px-2">
        <div class="d-flex align-items-center justify-content-center px-3">
            <div class="bar-grad">
                <span></span>
                <span class="w-50"></span>
            </div>
            <h1 class="text-center title p-5">Nos produits de tapis</h1>
            <div class="bar-grad">
                <span class="w-50"></span>
                <span></span>
            </div>
        </div>
        <div class="row m-0 p-3 px-5">

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
                i.id ASC 
            LIMIT 8 "; 

            $pdo = $connect->query($select);
            $prd = $pdo->fetchAll();

            foreach($prd as $value) { ?>

            <div class="col-lg-3 col-md-4 col-sm-6 col-6 prd">
                <a href="cartshopping.php?id=<?php echo $value['id'] ?>" class="">
                    <img src="FileImages/<?php echo $value['images'] ?>" class="img-fluid" alt="">
                </a>
                <div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            <h6 class="p-0 m-0 fw-bold"><?php echo $value['name'] ?></h6>
                            <small class="text-body-tertiary"><?php echo $value['title'] ?></small>
                        </div>
                        <h7><?php echo $value['ml'] ?> ML</h7>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold"> $<?php echo $value['prix'] ?></h5>
                        <i class="fa-solid fa-arrow-right text-body-tertiary fs-5"></i>
                    </div>
                </div>
            </div>     
            <?php } ?>
            <div class="text-center p-4">
                <a href="products.php" class="nav-link"><button class="btn px-4 py-2">Voir Tout <i class="fa-solid fa-arrow-right ms-1"></i></button></a>
            </div>
        </div>
    </div>
    <div class="meet">
        <div class="">
            <div class="serum py-5">
                <div class="bar-grad">
                    <span></span>
                    <span class="ms-3"></span>
                    <span></span>
                </div>
                <h1 class="mt-4">
                    Meet Our Number One 
                    <p>Seller <span class="pb-2 px-2 ms-2 text-white capillaire">Sérum Capillaire</span></p>
                </h1>
                <div class="bar-grad">
                    <span class="m-0"></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="d-flex gap-5 p-3 px-4">
            <img src="images/products/prd-003.jpg" class="img-fluid d-none d-xl-block d-xxl-block" alt="">
            <div class="w-100 content">
                <div class="d-flex align-items-center gap-3 p-">
                    <img src="images/products/prd-005.jpg" class="img-thumbnail" alt="">
                    <div class="w-50 text">
                        <div class="d-flex align-items-center justify-content-between py-2">
                            <h4>Sérum Capillaire</h4>
                            <h5 class="fs-6">30ml</h5>
                        </div>
                        <div class="">
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1 text-black"></i>  Helps your hear to grow natural</small>
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1 text-black"></i>  Gives Your Heair a Shinnig</small>
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1 text-black"></i>  Some Descriotion ...............</small>
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1 text-black"></i>  Some Descriotion ........</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="w-50 text">
                        <div class="d-flex align-items-center justify-content-between py-2">
                            <h4 class="capillaire text-white p-1 px-2">Sérum Capillaire</h4>
                            <h5 class="fs-6">30ml</h5>
                        </div>
                        <div class="">
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1"></i>  Helps your hear to grow natural</small>
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1"></i>  Gives Your Heair a Shinnig</small>
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1"></i>  Some Descriotion ...............</small>
                            <small class="pt-1"> <i class="fa-solid fa-star-of-life me-1"></i>  Some Descriotion ........</small>
                        </div>
                    </div>
                    <img src="images/products/prd-005.jpg" class="img-thumbnail" alt="">
                </div>
            </div>
        </div> 
    </div>

    <div class="nousoffrons">
        <div class="d-flex align-items-center justify-content-center px-3">
            <div class="bar-grad">
                <span></span>
                <span class="w-50"></span>
            </div>
            <h1 class="text-center p-5 title">Ce que nous offrons</h1>
            <div class="bar-grad">
                <span class="w-50"></span>
                <span></span>
            </div>
        </div>
        <div class="row m-0 gap-5 justify-content-center p-4">
            <div class="card col-lg-3 text-center p-4">
                <div class="">
                    <img src="images/services.svg" alt="">
                </div>
                <h3 class="rounded-5 border border-dark p-2 fw-bold">Service Client par Téléphone</h3>
                <p >Votre satisfaction est notre priorité.
                    Notre équipe de support client est
                    disponible 24h/24 et 7j/7
                </p>
            </div>
            <div class="card col-lg-3 text-center p-4">
                 <div class="text-center">
                    <img src="images/qualiter.svg" class="" alt="">
                 </div>
                <h3 class="rounded-5 border border-dark p-2 fw-bold">Meilleure Qualité</h3>
                <p>nos produits sont fabriqués à partir
                    d'ingrédients 100 % naturels, ce qui les
                    rend sans danger pour tous les types de
                    cheveux et de peau.
                </p>
            </div>
            <div class="card col-lg-3 text-center p-4">
               <div class="">
                    <img src="images/livraison.svg" alt="">

               </div>
                <h3 class="rounded-5 border border-dark p-2 fw-bold">Livraison Rapide et Gratuite</h3>
                <p>Avec notre service fiable, vous pouvez
                    faire vos achats en toute confiance,
                    sachant que vos articles seront en route
                    en un rien de temps.
                </p>
            </div>
        </div>
    </div>

    <?php require_once "required/footer.php" ?>