<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include_once 'lib/CurlHelper.php';
include_once 'lib/Interoperability.php';

//$siteName = utf8_decode($_GET["feedName"]);
//$siteUri= utf8_decode($_GET["feedUri"]);

$userServers = array();

if((isset($siteName) && strlen($siteName) > 0) && (isset($siteUri) && strlen($siteUri) > 0)){
    array_push($userServers, new TeamEndPoints($siteName, $siteUri));
}
else {
    array_push($userServers, new TeamEndPoints("The Beanz Products", "http://roncabeanz.com/Roncabeanz/ReadProducts.php"));
    array_push($userServers, new TeamEndPoints("Think Full Stack Products", "http://www.thinkinfullstack.com/project/apiproducts.php"));
}

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

<div class="row">
    <h1>Team Alpha Market Place</h1>
</div>


<?php
//Step2
foreach ($userServers as $cur) {
    $ch = new CurlHelper();
    $result = $ch->get($cur->requestUrl);
    $products = json_decode($result, TRUE);

    ?>

    <div class="row">

    </div>

    <div class="row">
        <h2><?php echo $cur->name; ?></h2>
    </div>


    <!-- Portfolio Gallery Grid -->
    <div class="infiniteContainer">
        <?php
        foreach ($products as $product) {
            $thumbnail = $product["thumbnail"];

            ?>
            <div class="infiniteCell">
                <a href= "<?php echo $product["clickTo"]; ?>">
                    <span class="data"> <img src="<?php echo $thumbnail; ?>" alt="<?php $product["name"] ?>" style="width:200px"></span>
                    <span class="data"> <h3><?php echo $product["name"] ?></h3></span>
                </a>
            </div>

            <?php
        }
        ?>
    </div>
    <!-- END MAIN -->
    <?php
}

?>
</body>
</html>
