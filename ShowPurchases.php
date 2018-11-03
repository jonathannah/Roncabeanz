<?php
include_once 'Cookies.php';
include_once 'lib/DBHelper.php';

$dbh = new DBHelper();

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
<h1>Orders</h1>

<table>
    <tr>
        <th>Order</th>
        <th>Date</th>
    </tr>
    <?php

        $uid=$_COOKIE[COOKIE_EMAIL];
        $query = "SELECT customerId, orderId, orderTime FROM Orders WHERE customerId='$uid'";
        $result = $dbh->query($query)

    ?>
    <?php
        while ($row = mysqli_fetch_array($result)){
            $date=new DateTime($row['orderTime']);
            $orderId = $row['orderId'];
            $link="PurchaseDetail.php?orderId=$orderId";
            ?>
            <tr>
                <td> <a href="<?php echo $link; ?>"><?php echo $orderId; ?></a></td>
                <td> <?php echo $date->format("Y-m-d H:i:s"); ?></td>
            </tr>
        <?php } ?>
</table>


<?php
//Step 4
$dbh->close();
?>

</body>
</html>