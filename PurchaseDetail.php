<?php
include_once 'lib/DBHelper.php';
include_once 'lib/Cookies.php';

$dbh = new DBHelper();

$orderId = htmlspecialchars($_GET["orderId"])
?>

<html>

<head>
    <link rel="stylesheet" href="css/Table.css" type="text/css" />
    <link href="css/Header.css" rel="stylesheet" type="text/css">


</head>
<body>

<div class="container">
    <?php include 'Header.php'; ?>
</div>
<div class="row"></div>
<h1>Order Details</h1>


<div>

    <?php
        // query order and get date,
        $orderId = htmlspecialchars($_GET["orderId"]);

        $query = "SELECT customerId, orderId, orderTime FROM Orders WHERE orderId='$orderId'";
        $result = $dbh->query($query);

        $row = mysqli_fetch_array($result);
        $date=new DateTime($row['orderTime']);

        echo $row['orderId'], ' ', $date->format("Y-m-d H:i:s");
    ?>
    &nbsp;

</div>

<!-- table for order items -->
<table>
    <tr>
        <th></th>
        <th>Product ID</th>
        <th>Name</th>
        <th>Qty</th>
        <th>Price</th>

    </tr>

    <?php
        $query = "SELECT itemNumber, price, productCode, quantity FROM OrderItem WHERE orderId=$orderId";
        $result = $dbh->query($query);
        while ($row = mysqli_fetch_array($result)) {
            $productCode = $row["productCode"];
            // lookup product name
            $itemNum = $row["itemNumber"];
            $query = "SELECT country, name from Coffee WHERE productCode=$productCode";
            $prodResult = $dbh->query($query);
            $prodRow = mysqli_fetch_array($prodResult);
            $prodName = $prodRow["country"].": ".$prodRow["name"];
            $qty = $row['quantity'];
            $price = $row["price"];

            ?>
            <tr>
                <td><?php echo $itemNum; ?></td>
                <td><?php echo $productCode; ?></td>
                <td><?php echo $prodName ?></td>
                <td><?php echo $qty ?></td>
                <td><?php echo $price ?></td>
            </tr>
            <?php
        }
    ?>

</table>


<?php
//Step 4
$dbh->close();
?>

</body>
</html>