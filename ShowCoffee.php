
<?php

include_once 'lib/RecentViews.php';
include_once 'lib/TotalViews.php';
include_once 'lib/Coffee.php';
include_once 'lib/DBHelper.php';

$rid = $_GET["productCode"];
$rViews = new RecentViews();
$rViews->put($rid);

$tViews = new TotalViews();
$tViews->put($rid);

$dbh = new DBHelper();
?>

<!doctype html>
<html>
<head>
    <?php
        session_start();
        $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
        session_write_close();
    ?>

    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/StarRating.css" rel="stylesheet" type="text/css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    {
      box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column1 {
      float: left;
      width:30%;
      padding: 10px;
      height: 300px; /* Should be removed. Only for demonstration */
    }
    .column2 {
      float: left;
      width: 40%;
      padding: 10px;
      height: 300px; /* Should be removed. Only for demonstration */
    }
	.column3 {
      float: left;
      width: 10%;
	  padding: 10px;
 	  vertical-align: top;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
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


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php include 'Header.php'; ?>

    <?php

    $coffee = Coffee::fromQuery($rid);
    ?>

    <div class="row">
        <h1><br></h1>
    </div>

    <!-- Profile logo. Add a img tag in place of <span>. -->
    <div>
      <div class="row" style="clear:both; margin-bottom: 10%">
          <div class="column1">
              <img src="<?php echo $coffee->thumbnail;?>" width="70%">
          </div>
          <div class="column2">
              <h2><left><?php echo $coffee->country ?> <?php echo $coffee->name ?></left></h2>
              <div class="star-ratings-css" style="margin-bottom: 10px;">
                  <div class="star-ratings-css-top" style="width: <?php echo $coffee->avgRating*20;?>%">
                      <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                  </div>
                  <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
              </div>

              <p><?php echo $coffee->description ?> </p>
         <div class="row">
            <div class="column3">
                <select class Column3>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
             </div>
            <div class="column3" >
                <P valign="top">LB</P>
            </div>
            <div class="column3" >


                <?php $item = new CartItem($coffee->productCode, 1, 1, $coffee->price); ?>

                <form action="AddToCart.php" method="POST">

                    <?php echo'<input type="hidden" name="productId" value="',$item->productId, '"/>'; ?>
                    <?php echo'<input type="hidden" name="count" value="',$item->count, '"/>'; ?>
                    <?php echo'<input type="hidden" name="amount" value="',$item->amount, '"/>'; ?>
                    <?php echo'<input type="hidden" name="cost" value="',$item->cost, '"/>'; ?>

                    <a href="#" onclick="this.parentNode.submit()">Add to Cart</a>

                    <?php
                        $query = "UPDATE Coffee SET viewCount = viewCount + 1 WHERE productCode = $rid";
                        $dbh->query($query);
                    ?>
                </form>
            </div>
        </div>
      </div>

  </div>
  <div style="clear: both;">
      <?php
      $query = "SELECT uId, rating, comments from Roncabeanz.Ratings WHERE productCode=".$coffee->productCode;
      $result = $dbh->query($query);
      $num_fields = mysqli_num_fields($result);
      $fields = mysqli_fetch_fields($result);
      ?>
      <table>
          <tr>
              <th>User</th>
              <th>Rating</th>
              <th>Comments</th>
          </tr>
          <?php
          while(($row = mysqli_fetch_array($result)) != null){
              echo '<tr>';
              echo '<td>', $row["uId"], '</td>';
              echo '<td>', $row["rating"], '</td>';
              echo '<td>', $row["comments"], '</td>';
              echo "</tr>";
          }
          ?>
      </table>
  </div>

  <?php
      //Step 4
      $dbh->close();
  ?>
</body>
</html>
