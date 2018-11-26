

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Roncabeanz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/AutoGrid.css" rel="stylesheet" type="text/css">
    <link href="css/roncabeanz_style.css" rel="stylesheet" type="text/css">
    <link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
    <link href="css/StarRating.css" rel="stylesheet" type="text/css">


</head>

<body>
<?php
    const ROW_COUNT = 5;
    include_once 'lib/ShoppingCart.php';
    include_once 'lib/Coffee.php';
    include_once 'lib/DBHelper.php';
    include_once 'lib/Cookies.php';
    include_once 'lib/RecentViews.php';
    include_once 'lib/TotalViews.php';

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
                            'thumbnail' => $coffee->thumbnail,
                            'avgRating' => $coffee->avgRating * 20
                    );

                }
                foreach($recentProds as $cur){
                    $prodName = $cur['country']." ".$cur['name'];
                ?>
                    <div class="cell">
                        <a href= "ShowCoffee.php?productCode=<?php echo urlencode($cur['productCode']);?>">
                            <div class="star-ratings-css" style="margin-bottom: 10px">
                                <div class="star-ratings-css-top" style="width: <?php echo $cur['avgRating'];?>%">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                </div>
                                <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <span class="data"> <img src="<?php echo $cur['thumbnail'];?>" style="width:200px"></span>
                            <span class="data"> <h3><?php echo $prodName ?></h3></span>

                        </a>
                    </div>
            <?php } ?>
        </div>
    </div>
<div>
    <?php
        if(isset($_COOKIE[COOKIE_NAME])) {
        $user = $_COOKIE[COOKIE_NAME];
        } else {
        $user = "<>";
        }
        ?>

    <h2>Viewed most by <?php echo $user ?></h2>
    <div class="container">
        <?php
        $tv = new TotalViews();
        $tvs = $tv->topFive();
        $recentProds = array();
        $idx = 0;
        foreach($tvs as $productCode){
            $coffee = Coffee::fromQuery($productCode);
            $recentProds[$idx++] = array
            (
                'country' => $coffee->country,
                'name' => $coffee->name,
                'productCode' => $coffee->productCode,
                'thumbnail' => $coffee->thumbnail,
                'avgRating' => $coffee->avgRating * 20
            );

        }
        foreach($recentProds as $cur){
            $prodName = $cur['country']." ".$cur['name'];
            ?>
            <div class="cell">
                <a href= "ShowCoffee.php?productCode=<?php echo urlencode($cur['productCode']);?>">
                    <div class="star-ratings-css" style="margin-bottom: 10px">
                        <div class="star-ratings-css-top" style="width: <?php echo $cur['avgRating'];?>%">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                    <span class="data"> <img src="<?php echo $cur['thumbnail'];?>" style="width:200px"></span>
                    <span class="data"> <h3><?php echo $prodName ?></h3></span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
    <div>
        <h2><br>Trending Coffees</h2>


        <div class="container">
            <?php
                $numItems = 0;
                $query = "SELECT productCode, name, country, price, description, thumbnail, viewCount FROM `Coffee` WHERE 1 ORDER BY viewCount DESC";
                $result = $dbh->query($query);
                while (($row = mysqli_fetch_array($result)) AND $numItems < ROW_COUNT){
                    $coffee = Coffee::fromRow($row);
                    $prodName = $row["country"]." ".$row["name"];
            ?>
                    <div class="cell">
                        <a href= "ShowCoffee.php?productCode=<?php echo urlencode($coffee->productCode);?>">
                            <div class="star-ratings-css" style="margin-bottom: 10px">
                                <div class="star-ratings-css-top" style="width: <?php echo $coffee->avgRating*20;?>%">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                </div>
                                <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
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
    </div>

    <?php
        if(isset($_COOKIE[COOKIE_EMAIL])) {
            $user = $_COOKIE[COOKIE_EMAIL];
        } else {
            $user = "";
        }

        if($user != "")
        {
            $left = "SELECT OrderItem.orderId, itemNumber, productCode from OrderItem ";
            $right = "LEFT JOIN Orders on OrderItem.orderId = Orders.orderId ";
            $cond ="WHERE (Orders.customerId ='$user') ORDER BY orderId DESC";
            $query = $left.$right.$cond;
            $result = $dbh->query($query);
            $items = array();
            while (($row = mysqli_fetch_array($result)) AND count($items) < ROW_COUNT){
                array_push($items, $row["productCode"]);
                $items = array_unique($items);
            }

            if(count($items) > 0)
            {
            ?>
                <div>
                    <h2><br>Buy Again</h2>
                    <div class="container">

                            <?php
                            foreach($items as $item){
                                $query = "SELECT productCode, name, country, price, description, thumbnail, viewCount FROM `Coffee` WHERE productCode=$item";
                                $result = $dbh->query($query);
                                $coffee = Coffee::fromRow(mysqli_fetch_array($result));
                                ?>
                                    <div class="cell">

                                         <a href= "ShowCoffee.php?productCode=<?php echo urlencode($coffee->productCode);?>">
                                             <div class="star-ratings-css" style="margin-bottom: 10px">
                                                 <div class="star-ratings-css-top" style="width: <?php echo$coffee->avgRating*20;?>%">
                                                     <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                                 </div>
                                                 <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                             </div>
                                             <div class="content">
                                                <span class="data"> <img src="<?php echo $coffee->thumbnail;?>" style="width:200px"></span>
                                                <span class="data"> <h3><?php echo $coffee->displayName(); ?></h3></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }?>
                    </div>
                </div>
            <?php
            }

        }

        $dbh->close();
    ?>
</body>
</html>


