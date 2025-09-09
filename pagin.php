
<?php require_once "required/header.php" ?>

    <div class="container mt-4">
        <div class="row" id="product-container"></div>

        <h1 class="bg-dark"> welcome</h1>
        <nav aria-label="Page navigation ">
           
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>

    <script>
        const products = [
            'images/products/prd-007.jpg', 'rajaraja.jpeg', 'wallpaper.jpg', 'confident-handsome-guy-posing-against-white-wall.jpg'
        ];

        const itemsPerPage = 1;
        let currentPage = 1;

        function displayProducts(page) {
            const productContainer = document.getElementById('product-container');
            productContainer.innerHTML = '';

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = products.slice(start, end);

            paginatedItems.forEach(item => {
                const img = document.createElement('img');
                img.src = item;
                img.alt = 'Product Image';
                img.className = 'product col-md-3'; 
                productContainer.appendChild(img);
            });
        }

        function setupPagination() {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            const pageCount = Math.ceil(products.length / itemsPerPage);
            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement('li');
                li.className = 'page-item' + (i === currentPage ? ' active' : '');
                li.innerHTML = <a class="page-link" href="#">${i}</a>;
                li.addEventListener('click', function (e) {
                    e.preventDefault();
                    currentPage = i;
                    displayProducts(currentPage);
                    setupPagination();
                });
                pagination.appendChild(li);
            }
        }

        displayProducts(currentPage);
        setupPagination();
    </script>

<?php require_once "required/footer.php" ?>