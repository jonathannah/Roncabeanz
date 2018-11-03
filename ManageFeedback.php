<?php
include_once 'lib/ShoppingCart.php';
include_once 'lib/DBHelper.php';
$dbh = new DBHelper();
?>

<html>

 <head>
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
    <link rel="stylesheet" href="roncabeanz_style.css" type="text/css" />
    <link href="css/Header.css" rel="stylesheet" type="text/css">
 </head>
 <body>
 <?php session_start(); ?>
 <?php $_SESSION['ref'] = $_SERVER['SCRIPT_NAME']; ?>

 <div class="container">
     <?php include 'Header.php'; ?>
 </div>
 <div class="row"></div>
 <h1>Beanz Customer Feedback</h1>

<?php
//Step2
$query = "SELECT firstName, lastName, email, comments FROM CustomerContactRequests WHERE 1 ORDER BY lastname, firstName";
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
		<?php } ?> </tr>
<?php } ?>
</table>
<?php
 //Step 4
 $dbh->close();
 ?>

</body>
</html>