<?php
include_once 'lib/DBHelper.php';
include_once 'lib/ShoppingCart.php';

$dbh = new DBHelper();

session_start();
$shoppingCart = $_SESSION[SHOPPING_CART];
session_write_close();
?>

<html>

<head>
    <link rel="stylesheet" href="roncabeanz_style.css" type="text/css" />
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

</head>
<body>

<div class="container">
    <?php include 'Header.php'; ?>
</div>
<div class="row"></div>
<h1>The Beanz Customers</h1>

<?php
//Step2

?>

<table>
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Name</th>
        <th>Price</th>
        <th>Item Total</th>
    </tr>
    <?php
        if($shoppingCart != null){
            $totalCost = 0;
            for ($i = 0; $i < count($shoppingCart->getCartItems()); ++$i){
                echo '<tr>';
                $item = $shoppingCart->getCartItems()[$i];
                $query = "SELECT name, country, price, units FROM Roncabeanz.Coffee  WHERE productCode = $item->productId ORDER BY 'name'";
                $result = $dbh->query($query);
                $row = mysqli_fetch_array($result);
                echo '<td>', $i, '</td>';
                echo '<td>', $item->count, ' ', $row["units"], '</td>';
                echo '<td>',$row["country"] , ' ', $row["name"], '</td>';
                $totalCost += ($item->count * $row["price"]);
                echo '<td>', $row["price"], '</td>';
                echo '<td>', $item->count * $row["price"], '</td>';
                echo '</tr>';
            }
            echo '<tr><td></td><td></td><td>Total</td><td></td><td>', $totalCost, '</td></tr>';
        }


    ?>
</table>

<div>
    <?php
        if($shoppingCart != null AND !$shoppingCart->isEmpty())
        {
            ?>
                <a href="Purchase.php">Purchase</a>
            <?php

        }
    ?>
</div>
<?php
//Step 4
$dbh->close();
?>

</body>
</html>