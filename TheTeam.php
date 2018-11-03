<?php
include 'lib/DBHelper.php';

$dbh = new DBHelper();

?>

<html>

 <head>
	<link rel="stylesheet" href="roncabeanz_style.css" type="text/css" />
    <link href="css/Header.css" rel="stylesheet" type="text/css">

 </head>
 <body>
 <?php
     session_start();
     $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
     session_write_close();
 ?>
 <div class="wrapperContainer">
        <?php include 'Header.php'; ?>

    </div>

 <div class="row">

 </div>

 <h1>The Beanz Team</h1>

<?php
//Step2
$query = "SELECT * FROM `Team` WHERE 1";

//Step3
$result = $dbh->query($query);
$num_fields = mysqli_num_fields($result);
$fields = mysqli_fetch_fields($result);
//$row = mysqli_fetch_array($result);
?>
<table>
    <tr>
        <?php for ($i = 0; $i < $num_fields; $i++){ ?>
                <th><?php echo $fields[$i]->name;?></th>
        <?php } ?>
    </tr>
        <?php while ($row = mysqli_fetch_array($result)) {?>
            <tr>
            <?php for ($i = 0; $i < $num_fields; $i++){?>
            <td><?php echo $row[$fields[$i]->name] ?></td>
            <?php } ?>
        <?php } ?>
    </tr>
</table>
<?php
 //Step 4
 $dbh->close();
 ?>

</body>
</html>