<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/3/18
 * Time: 9:13 AM
 */

include 'lib/DBHelper.php';

$dbh = new DBHelper();


?>

<html>

 <head>
	<link rel="stylesheet" href="css/roncabeanz_style.css" type="text/css" />
     <link href="css/Header.css" rel="stylesheet" type="text/css">
     <style>
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

 </head>
 <body>
 <?php
     session_start();
     $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
     session_write_close();
 ?>

  <script>
      let lastSortCol = 0;
      let lastSortAscending = false;

      function sortTable(col) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("ProductTable");
        switching = true;
        let ascending = true;

        if(lastSortCol == col)
        {
            ascending = !lastSortAscending;
        }

        lastSortCol = col;
        lastSortAscending = ascending;

          // bubble sort
        while (switching) {
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("td")[col];
                y = rows[i + 1].getElementsByTagName("td")[col];
                //check if the two rows should switch place:

                if(!isNaN(x.innerHTML) )
                {
                    if((ascending && Number(x.innerHTML) > Number(y.innerHTML)) || (!ascending && Number(x.innerHTML) < Number(y.innerHTML))){
                        shouldSwitch = true;
                    }
                }
                else if
                (
                    (ascending && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                    (!ascending && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())
                )
                {
                     //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                }

                if(shouldSwitch){
                    break;
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

 </script>

 <div class="container">
    <?php include 'Header.php'; ?>
  </div>
 <div class="row"></div>
 <h1>The Beanz Inventory</h1>

<?php
//Step2
$query = "SELECT country, name, price, units, description, productCode, thumbnail, viewCount FROM `Coffee` ORDER BY country, name ASC";

//Step3
$result = $dbh->query($query);
$num_fields = mysqli_num_fields($result);
$fields = mysqli_fetch_fields($result);
//$row = mysqli_fetch_array($result);
?>
<table id="ProductTable">
    <tr>
        <?php for ($i = 0; $i < $num_fields; $i++){ ?>
            <th>
                <?php
                    if($i < 3 || $i > 4){
                        echo '<a href="#" onClick="sortTable(', $i, ')">', $fields[$i]->name, '</a>';
                    }
                    else {
                        echo $fields[$i]->name;
                    }
                ?>
            </th>
        <?php } ?>
    </tr>
    <?php while ($row = mysqli_fetch_array($result)) {?>
        <tr>
             <?php for ($i = 0; $i < $num_fields; $i++){?>
                <td onclick="location.href='ShowCoffee.php?productCode=<?php echo $row["productCode"];?>'">
                    <?php
                        if ($i < 0)
                        {
                            echo '<a href="ShowCoffee.php?productCode=', urlencode($row["productCode"]), '"">';
                        }
                        echo $row[$fields[$i]->name];
                        if($i < 2){
                            echo '</a>';
                        }
                        ?>
                </td>
            <?php } ?>

        </tr>
    <?php } ?>
</table>
<?php
 //Step 4
$dbh->close();
 ?>

</body>
</html>