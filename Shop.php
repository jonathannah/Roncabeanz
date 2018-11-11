<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include 'lib/DBHelper.php';

$dbh = new DBHelper();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
<link href="css/Header.css" rel="stylesheet" type="text/css">

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
    $query = "SELECT name, country, price, description, productCode, thumbnail FROM `Coffee` ORDER BY country, name ASC";

    //Step3
    $result = $dbh->query($query);
    $fields = mysqli_fetch_fields($result);
    ?>

    <!-- Portfolio Gallery Grid -->
    <div class="container">
        <?php while ($row = mysqli_fetch_array($result)) {
            $thumbnail = " images/CoffeeThumbnail.jpg";
            if($row["thumbnail"] != null)
            {
                $thumbnail = "images/".$row["thumbnail"];
            }
            ?>
            <div class="cell">
                <a href= "ShowCoffee.php?productCode=<?php echo urlencode($row['productCode']);?>">
                    <span class="data"> <img src="<?php echo $thumbnail;?>" alt="<?php $row[$fields[1]->name] ?>" style="width:100%"></span>
                    <span class="data"> <h3><?php echo $row[$fields[1]->name], ' ', $row[$fields[0]->name] ?></h3></span>
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
