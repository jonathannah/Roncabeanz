<?php
    include_once 'lib/User.php';
    include_once 'lib/DBHelper.php';
    include_once 'lib/Coffee.php';

    $ref = $_SESSION['ref'];
    $pathParts = explode("/", $ref);
    $page = end($pathParts);

    if(isset($_GET["returnTo"])){
        $returnTo = $_GET["returnTo"];
    }
    else{
        $returnTo = $page;
    }

    $uToken = null;
    if(isset($_GET["userToken"]))
    {
        $uToken = $_GET["userToken"];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rate Product</title>
    <link href="css/roncabeanz_style.css" rel="stylesheet" type="text/css">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/StarRating.css" rel="stylesheet" type="text/css">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 10%;
        }

        td, th {
            font-size: 2.5vh;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        textarea {
            width: 80%;
            height: 60%;
            resize: none;
            font-size: 2vh;
        }
        .Center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input[type="submit"][disabled]:hover
        {
            border: 2px outset ButtonFace;
            color: GrayText;
            cursor: inherit;
            background-color: #ddd;
            background: #ddd;
        }

    </style>

>
<?php

$dbh = new DBHelper();

$productCode = $_GET["productCode"];

$user = null;
if($uToken != null){
    $user = User::fromToken($uToken);
}
else{
    $user = User::getCurrentUser();
}

$initialRating = 0;
$initialComments = "";

if($user != null){
    $coffee = Coffee::fromQuery($productCode);

    $query = "SELECT rating, comments FROM Roncabeanz.Ratings WHERE productCode = $productCode AND uid = '$user->email'";
    error_log($query);
    $result = $dbh->query($query);
    if($result->num_rows > 0){
        $row = mysqli_fetch_array($result);
        $initialRating = $row["rating"];
        $initialComments = $row["comments"];
        error_log("Rating: $initialRating   Comments: $initialComments");
    }
}
?>
    <script>
        var lastHoverRating = <?php echo $initialRating;?> ;
        var initialRating = <?php echo $initialRating;?>;
        var curRating = initialRating;
        var initialComments = <?php echo '"',$initialComments,'"';?>;

        function checkEnableSubmit(){
            var enable = (curRating != initialRating) || (initialComments != document.getElementById("comments").value);
            document.getElementById("submit").disabled = !enable;


        }

        function onLoad() {
            document.getElementById("submitBtn").disabled = true;
        }
        function mouseOver(e) {
            var rect = document.getElementById("starRating").getBoundingClientRect();
            var xpos = Math.max(Math.min(e.clientX - document.getElementById("starRating").getBoundingClientRect().left, rect.width), 0);


            var rating =  Math.round((100*xpos/rect.width)/20);
            var ratingPct = rating * 20;

            if(lastHoverRating != rating) {
                document.getElementById("starRatingUpper").style.width = '' + ratingPct + "%";
                lastHoverRating = rating;
            }
        }

        function mouseOut() {
            document.getElementById("starRatingUpper").offsetWidth=curRating * 20;
            checkEnableSubmit();
        }

        function mouseDown(e) {
            curRating = lastHoverRating;
            document.getElementById("rating").value=curRating;
            checkEnableSubmit()
        }

    </script>

</head


<body>
<?php
    include 'Header.php';
?>

<div class="row" style="clear: both">
    <br>
</div>
<div style="margin-bottom: 15px">
    <h2 style="font-size: 2.5vh"><br>Hello <?php echo $user->fname;?>, Rate <?php echo $coffee->country, " ", $coffee->name;?><br></h2>
</div>

<form name="ratingform" method="post" action="AddRating.php" style="width: 80%; height: 60%">
    <div>
        <input type="hidden" name="user" id="user" value="<?php echo $user->email;?>"/>
        <input type="hidden" name="rating" id="rating" value="<?php echo $initialRating;?>"/>
        <input type="hidden" name="productCode" id="productCode" value="<?php echo $productCode;?>"/>
        <input type="hidden" name="domain" id="domain" value="Roncabeanz.com"/>
        <div style="clear: both; margin-bottom: 10px">
            <table>
                <tr>
                    <td width="15%">Rating</td>
                    <td>
                        <div id="starRating" class="star-ratings-css" style="margin-bottom: 10px;" onmouseout="mouseOut(event)" onmousedown="mouseDown(event)" onmousemove="mouseOver(event)">
                            <div id="starRatingUpper" class="star-ratings-css-top" style="width: <?php echo $initialRating*20;?>%">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>

                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 10px; margin-bottom: 10px">
            <h2>Comments</h2>
            <textarea  id="comments" name="comments" maxlength="1000" rows="20" oninput="checkEnableSubmit()"><?php echo $initialComments;?></textarea>
        </div>
    </div>
    <button id="submit" class="btn" type="submit" style="width: 10%;" disabled="disabled" >Submit</button>

</form>


</body>
</html>