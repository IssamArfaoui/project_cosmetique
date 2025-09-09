<?php require_once "required/header.php"; ?>

<div class="productsPage">
    <div class="col col-12 col-lg-5 col-md-3 position-absolute top-50 start-50 translate-middle-x text-center">
        <a href="#prd" class="nav-link ">
            <button class="btn px-5 py-4 rounded-0">Achetez maintenant
                <i class="fa-solid fa-arrow-down ms-1"></i>
            </button>
        </a>
    </div>
</div>

<?php 

$itemsPerPage = 8;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 

$query = "SELECT COUNT(*) FROM products WHERE is_deleted = 0";
$stmt = $connect->query($query);
$totalItems = $stmt->fetchColumn(); 
$totalPages = ceil($totalItems / $itemsPerPage);

$currentPage = max(1, min($currentPage, $totalPages));

$start = ($currentPage - 1) * $itemsPerPage;

$query = "SELECT 
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
    LIMIT :start, :limit";

$stmt = $connect->prepare($query);
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="productsPages">
    <div class="p-2">
        <h1 class="text-center title p-5">Page Produits</h1>
        <div id="prd" class="row justify-content-center align-items-center m-0 p-5 gap-2 ">
            <div class="container mt-4">
                <div class="row" id="product-container">
                    <?php  
                     foreach($products as $value) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 col">
                            <a href="cartshopping.php?id=<?php echo $value['id'] ?>" class="nav-link">
                                <img src="FileImages/<?php echo $value['images'] ?>" class="img-fluid" alt="">
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
                            </a>
                        </div>     
                    <?php } ?>
                </div>

                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                      
                        <li class="page-item <?php echo ($currentPage == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo ($currentPage > 1) ? $currentPage - 1 : 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php 
                        
                        $range = 2; 
                        for ($i = max(1, $currentPage - $range); $i <= min($totalPages, $currentPage + $range); $i++): ?>
                            <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php require_once "required/footer.php"; ?>
