

<?php 
    require_once "Require/Header.php";

    require_once "../required/configue.php";

    $select = "SELECT * FROM `collection`";
    $pdo = $connect->query($select);
    $prd = $pdo->fetchAll()

?>

<style>
    table {
        width: 100%;
    }
     table tr th:first-child {
        width: 140px;
     }
    img {
        width: 100%;
    }
    
</style>
<table border class="p-2">

    <tr class="text-center">
        <th>image</th>
        <th>name-Collection</th>
        <th colspan=2 >action</th>
    </tr>

    <?php foreach($prd as $value) { ?>
        <tr class="text-center">
            <td><img src="../FileImages/<?php echo $value['image'] ?>" alt=""></td>  
            <td><?php echo $value['name'] ?> </td>
            <td>
                <a href="deleteCollection.php?id=<?php echo $value['id']; ?>" 
                    onclick="return confirm('Are you sure you want to delete this collection?');">
                    <i class="text-danger fa-solid fa-trash"></i>
                </a>
            </td>
            <td>
            <a href="editCollection.php?id=<?php echo $value['id'];?>"><i class=" fa-solid fa-pen-to-square"></i></a>
            </td>
        </tr>

    <?php } ?>

</table>



<?php
require_once "Require/Footer.php"
?>