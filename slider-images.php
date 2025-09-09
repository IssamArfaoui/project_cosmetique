<?php
require_once "required/header.php";
?>

<style>
    img {
        width: 100px;
    }
</style>

<?php 

$product_id = $_GET['id'];

$select = "SELECT products.id, products.name, i.images 
           FROM products 
           JOIN images i ON products.id = i.prd_id 
           WHERE products.id = ?";

$stmt = $connect->prepare($select);

$stmt->bindParam(1, $product_id, PDO::PARAM_INT);
$stmt->execute();

$product = $stmt->fetchAll();

if ($product) {

    foreach ($product as $row) {

         echo "Product ID: " . $row['id'] . "<br>";
        echo "Product Name: " . $row['name'] . "<br>";
        echo "Image: <img src='FileImages/" . $row['images'] . "' alt='Product Image'><br>";
    }
} else {
    
    echo "No product found.";
}
?>    <script>
let images = document.getElementById('images').children;
let template = document.getElementById('template');
let colors = ['gold', 'blue', 'black', 'gray', 'red' ]
let background = document.querySelector('.child-1');
let size = document.querySelector('.size').children;

for (let i=0 ;i<images.length;i++) {
images[i].addEventListener('click',function() {
template.src=images[i].src;
background.style.backgroundColor = colors[i];
})
}

for (let i=0;i<size.length;i++) {
size[i].addEventListener('click',function(){
for (let j=0; j<size.length;j++) {
    size[j].style.border='';
}
size[i].style.border='3px solid red';
})
}


<?php require_once "required/footer.php"; ?>
