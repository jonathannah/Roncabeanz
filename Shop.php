<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once 'lib/DBHelper.php';
include_once 'lib/Coffee.php';

$dbh = new DBHelper();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
<link href="css/Header.css" rel="stylesheet" type="text/css">
<link href="css/StarRating.css" rel="stylesheet" type="text/css">

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}


    </style>
</head>
<body>
<?php
    session_start();
    $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
    session_write_close();
?>

<!-- MAIN (Center website) -->
    <!--**************************************************************************
    Header starts here. It contains Logo and 3 navigation links.
    ****************************************************************************-->

    <?php include 'Header.php'; ?>


<div class="row">

</div>

<div class="row">
    <h2>Current Inventory</h2>
</div>

  <?php
    //Step2
    $query = "SELECT * FROM `Coffee` ORDER BY country, name ASC";

    //Step3
    $result = $dbh->query($query);
    $fields = mysqli_fetch_fields($result);
    ?>

    <!-- Portfolio Gallery Grid -->
    <div class="container">
        <?php while ($row = mysqli_fetch_array($result)) {
            $coffee = Coffee::fromRow($row);

            ?>
            <div class="cell">
                <a href= "ShowCoffee.php?productCode=<?php echo urlencode($row['productCode']);?>">
                    <div class="star-ratings-css" style="margin-bottom: 10px">
                        <div class="star-ratings-css-top" style="width: <?php echo $coffee->avgRating*20;?>%">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                    <span class="data"> <img src="<?php echo $coffee->thumbnail;?>" alt="<?php $coffee->name ?>" style="width:100%"></span>
                    <span class="data"> <h3><?php echo $coffee->country, ' ', $coffee->name ?></h3></span>
                </a>
            </div>

        <?php } ?>
    </div>
    <!-- END MAIN -->
</div>
<?php
//Step 4
$dbh->close();
?>
</body>
</html>
