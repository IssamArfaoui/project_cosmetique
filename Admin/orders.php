<?php
require_once "Require/Header.php";  // Include the header file
require_once "../required/configue.php";  // Include your DB configuration file

// Fetch orders from the checkout table
$select = "SELECT * FROM orders";
$sql = $connect->query($select);
$orders = $sql->fetchAll();  // Get all rows from the checkout table

// Group orders by customer
if ($orders) {
    $customers = [];
    foreach ($orders as $order) {
        // Create a unique key for each customer by concatenating their details
        $customerKey = $order['name'] . '|' . $order['email'] . '|' . $order['number'] . '|' . $order['address']. '|' . $order['date_commande'];
        if (!isset($customers[$customerKey])) {
            $customers[$customerKey] = [];
        }
        $customers[$customerKey][] = $order;
    }
?>

<title>Orders</title>
<style>
    table img {
        width: 80px;
    }
    table {
        width: 100%;
    }
    .card {
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
</style>

<h1 class="m-3">Orders</h1>
<?php
    // Loop through each customer and their orders
    foreach ($customers as $customerKey => $orders) {
        list($name, $email, $phone, $address,$date_commende) = explode('|', $customerKey);
?>
    <div class="card">
        <div class="p-2 my-3 d-flex">
            <div>
                <h5>Name: <?php echo htmlspecialchars($name); ?></h5>
                <h5>Phone: <?php echo htmlspecialchars($phone); ?></h5>
                <h5>Email: <?php echo htmlspecialchars($email); ?></h5>
                <h5>Address: <?php echo htmlspecialchars($address); ?></h5>
            </div>
            <div>
              <h5 class="text-dark "><span class="fw-bolde">Date_de_Commende</span> : <?php echo htmlspecialchars($date_commende); ?></h5>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) { ?>
                <tr>
                    <td class="align-middle"><img src="../FileImages/<?php echo htmlspecialchars($order['images']); ?>" alt=""></td>
                    <td class="align-middle"><?php echo htmlspecialchars($order['title']); ?></td>
                    <td class="align-middle">$<?php echo number_format($order['prix'], 2); ?></td>
                    <td class="align-middle">x<?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td class="align-middle">
                        <!-- <a href="delete_orders.php?id=<?php echo $order['id']; ?>"><i class="delete text-danger fa-solid fa-trash"></i></a> -->
                        <a href="delete_orders.php?id=<?php echo $order['id']; ?>" 
                            onclick="return confirm('Are you sure you want to delete this order ?');">
                            <i class="text-danger fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php
} else {
    echo "<div class='alert alert-danger m-4'>
        <h1>No orders right now.</h1>
    </div>";
}

require_once "Require/Footer.php";  // Include the footer
?>
