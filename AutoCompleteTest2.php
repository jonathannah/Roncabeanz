<?php

include_once 'lib/DBHelper.php';

$dbh = new DBHelper();

$query = "SELECT CONCAT(country, ' ', name) as name, productCode from Coffee ORDER BY country";
$result = $dbh->query($query);
$searchArray = array();
$productCodes = array();

while (($row = mysqli_fetch_array($result))){
    array_push($searchArray, $row["name"]);
    $productCodes[$row["name"]] = $row["productCode"];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Autocomplete - Default functionality</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            var availableTags = <?php echo json_encode($searchArray);?>;
            $( "#tags" ).autocomplete({
                source: availableTags
            });
        } );
    </script>

</head>
<body>

<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags", placeholder="Search Coffees", style="width: 25%">
</div>

<script>
    var input = document.getElementById("tags");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            var name = document.getElementById("tags").value;
            var prodIdx = <?php echo json_encode($productCodes); ?>;
            var productCode = prodIdx[name];
            window.location.href = "ShowCoffee.php?productCode=" + productCode;
        }
    });
</script>

</body>
</html>