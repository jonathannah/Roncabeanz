<?php
include_once 'lib/Cookies.php';
include_once 'lib/DBHelper.php';
include_once 'lib/User.php';

$dbh = new DBHelper();

$uid = htmlspecialchars($_GET["uid"]);
$cust = User::fromQuery($uid);

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

<div>
    <h1> Customer Info</h1>
    <table>
        <tr>
            <td>First Name</td>
            <td><?php echo $cust->fname;?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?php echo $cust->lname;?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td> <?php echo $cust->address;?></td>
        </tr>
        <tr>
            <td>City</td>
            <td><?php echo $cust->city;?></td>
        </tr>
        <tr>
            <td>State</td>
            <td><?php echo $cust->state;?></td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td><?php echo $cust->zipCode;?></td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td><?php echo $cust->homePhone;?></td>
        </tr>
        <tr>
            <td>Cell Phone Number</td>
            <td><?php echo $cust->cellPhone;?></td>
        </tr>

    </table>
</div>
<h1>Orders</h1>

<table>
    <tr>
        <th>Order</th>
        <th>Date</th>
    </tr>
    <?php

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