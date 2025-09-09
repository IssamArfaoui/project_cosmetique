

<?php 

    require_once "Require/Header.php";

    require_once "../required/configue.php";

    $select = "SELECT products.id, products.name, products.typeprd,products.title,
            products.ml,products.prix,products.is_deleted, i.images 
            FROM products 
            JOIN images i ON products.id = i.prd_id
            GROUP BY 
            products.id 
            ";

    $pdo = $connect->query($select);
    $prd = $pdo->fetchAll();

?>

<style>
    table {
        width: 100%;
    }
     table tr th:first-child {
        width: 120px;
     }
    img {
        width: 100%;
    }
    
</style>
<table border class="p-2">

    <tr class="text-center">
        <th>image</th>
        <th>name</th>
        <th>title</th>
        <th>ml</th>
        <th>prix</th>
        <th colspan=3 >action</th>
    </tr>

    <?php foreach($prd as $value) { ?>
        <tr class="text-center">
            <td><img src="../FileImages/<?php echo $value['images'] ?>" alt=""></td>  
            <td>
                <?php echo $value['name'] ?> 
                <p class='text-dark'> TypePrd : <?php echo $value['typeprd'] ?></p>
            </td>
            <td><?php echo $value['title'] ?></td>
            <td><?php echo $value['ml'] ?></td>
            <td><?php echo $value['prix'] ?></td>
            <td>
                <?php if ($value['is_deleted'] == 0) { ?>
                    <a class="text-success nav-link" href="CacheProduct.php?id=<?php echo $value['id']; ?>">Active </a>
                <?php } else { ?>
                    <a class="text-danger nav-link" href="restore_Product.php?id=<?php echo $value['id']; ?>">Désactivé </a>
                <?php } ?> 
            </td>
            <td class="px-3">
                <a href="deleteProduct.php?id=<?php echo $value['id']; ?>" 
                    onclick="return confirm('Are you sure you want to delete this Product ?');">
                    <i class="text-danger fa-solid fa-trash"></i>
                </a>
            </td>
            <td class="px-3">
                <a href="editProduct.php?id=<?php echo $value['id'];?>"><i class=" fa-solid fa-pen-to-square"></i></a>
            </td> 
        </tr>

    <?php } ?>

</table>



<?php
require_once "Require/Footer.php"
?>