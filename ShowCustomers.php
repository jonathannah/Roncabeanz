<?php
include 'lib/DBHelper.php';

$dbh = new DBHelper();


?>

<html>

 <head>
	<link rel="stylesheet" href="roncabeanz_style.css" type="text/css" />
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
 <div class="container">
    <?php include 'Header.php'; ?>
  </div>
 <div class="row"></div>
 <h1>The Beanz Customers</h1>

<?php
//Step2
$query = "SELECT lastName, firstName, emailAddress FROM  `User` WHERE groupID = 'Customer' ORDER BY lastname, firstName";

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
		<?php } ?> </tr>
<?php } ?>
</table>
<?php
 //Step 4
$dbh->close();
 ?>

</body>
</html>