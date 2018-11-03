

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Roncabeanz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
    <link href="css/roncabeanz_style.css" rel="stylesheet" type="text/css">
    <link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">


</head>

<body>
<?php
    define(ROW_COUNT, 5);
    include_once 'lib/ShoppingCart.php';
    include_once 'lib/Coffee.php';
    include_once 'lib/DBHelper.php';
    include_once 'Cookies.php';
    include_once 'lib/RecentViews.php';

    session_start();
    $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
    if($_SESSION[SHOPPING_CART] == null) {
        $_SESSION[SHOPPING_CART] = new ShoppingCart();
  //      for($i=0; $i<4; ++$i){
    //        $_SESSION[SHOPPING_CART]->push(new CartItem($i, $i+1, 3, 6.99));
        }
    //}
    session_write_close();

    $dbh = new DBHelper();
?>



    <div class="wrapperContainer">
        <?php include 'Header.php'; ?>
    </div>
    <div>
        <nav class="secondary_header" id="menu">
            <ul>
                <li><a class="nav" href="Blog.php">Coffee Blog</li>
                <li><a class="nav" href="Shop.php">Shop</li>
                <li><a class="nav" href="About.php">About</a></li>
                <li><a class="nav" href="TheTeam.php">The Team</a></li>
                <li><a class="nav" href="ContactUs.php">Contact Us</a></li>
             </ul>
        </nav>
    </div>
    <div>&nbsp;</div>
    <div>
        <h2>Recently Viewed</h2>
        <div class="container">
            <?php
                $rv = new RecentViews();
                $recentProds = array();
                for($i = 0; $i < $rv->size() AND $i < ROW_COUNT; ++$i){
                    $productCode = $rv->get($i);
                    $coffee = Coffee::fromQuery($productCode);
                    $recentProds[$i] = array
                    (
                            'country' => $coffee->country,
                            'name' => $coffee->name,
                            'productCode' => $coffee->productCode,
                            'thumbnail' => $coffee->thumbnail
                    );

                }
                foreach($recentProds as $cur){
                    $prodName = $cur['country']." ".$cur['name'];
                ?>
                    <div class="cell">
                        <a href= "ShowCoffee.php?productCode=<?php echo urlencode($cur['productCode']);?>">
                            <span class="data"> <img src="<?php echo $cur['thumbnail'];?>" style="width:200px"></span>
                            <span class="data"> <h3><?php echo $prodName ?></h3></span>
                        </a>
                    </div>
            <?php } ?>
        </div>
    </div>
    <div>
        <h2><br>Trending Coffees</h2>

    </div>
    <div class="container">
        <?php
            $numItems = 0;
            $query = "SELECT productCode, name, country, price, units, description, thumbnail, viewCount FROM `Coffee` WHERE 1 ORDER BY viewCount DESC";
            $result = $dbh->query($query);
            while (($row = mysqli_fetch_array($result)) AND $numItems < ROW_COUNT){
                $coffee = Coffee::fromRow($row);
                $prodName = $row["country"]." ".$row["name"];
        ?>
                <div class="cell">
                    <a href= "ShowCoffee.php?productCode=<?php echo urlencode($coffee->productCode);?>">
                        <div class="content">
                            <span class="data"> <img src="<?php echo $coffee->thumbnail;?>" style="width:200px"></span>
                            <span class="data"> <h3><?php echo $prodName; ?></h3></span>
                        </div>
                    </a>
                </div>
        <?php
            ++$numItems;
            }
        ?>

    </div>

<?php /*
    <div>
        <h2>Buy Again</h2>
        <div class="wide_row">
           <?php for($i = 0; $i < ROW_COUNT; ++$i){?>
               <div class="wide_column">
                    <div class="content">
                        <img src="images/CoffeeThumbnail.jpg" style="width:100%">
                        <h3>BItem</h3>
                   </div>
               </div>
            <?php } ?>
        </div>
    </div>
 */?>
<?php $dbh->close(); ?>
</body>
</html>


