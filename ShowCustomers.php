<?php
include_once 'lib/DBHelper.php';

$dbh = new DBHelper();

$userSearchIndex = array();
$userSearchMap = array();

?>

<html>

 <head>
	<link rel="stylesheet" href="css/roncabeanz_style.css" type="text/css" />
     <link href="css/Header.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
 <div>

     <div class="ui-widget">
         <label for="searchUser">Search by Name, email, or phone number: </label>
         <input id="searchUser", placeholder="Search User", style="width: 25%">
     </div>


 </div>
 <h1>The Beanz Customers</h1>

<?php
//Step2
$query = "SELECT *  FROM  `User` WHERE groupID = 'Customer' ORDER BY lastname, firstName";

//Step3
$result = $dbh->query($query);
$num_fields = mysqli_num_fields($result);
$fields = mysqli_fetch_fields($result);
//$row = mysqli_fetch_array($result);
?>
<table>
		<tr>
			<?php for ($i = 0; $i < $num_fields-1; $i++){ ?>
					<th><?php echo $fields[$i]->name;?></th>
			<?php } ?>
		</tr>
<?php while ($row = mysqli_fetch_array($result)) {?>
		<tr>
            <?php
                $curUser = User::fromRow($row);
                $curName = $curUser->fname." ".$curUser->lname;
                array_push($userSearchIndex,  $curName);
                $userSearchMap[$curName] = $curUser->email;
                array_push($userSearchIndex, $curUser->homePhone);
                $userSearchMap[$curUser->homePhone] = $curUser->email;
                array_push($userSearchIndex, $curUser->cellPhone);
                $userSearchMap[$curUser->cellPhone] = $curUser->email;
                array_push($userSearchIndex, $curUser->email);
                $userSearchMap[$curUser->email] = $curUser->email;
            ?>

            <td><?php echo $curUser->lname ?></td>
            <td><?php echo $curUser->fname ?></td>
            <?php $uemail = $curUser->email; ?>
            <td><a href="ShowCustomer.php?uid=<?php echo urlencode($uemail); ?>"><?php echo $uemail ?></a></td>
            <td>********</td>
            <td><?php echo $curUser->address;?></td>
            <td><?php echo $curUser->apt;?></td>
            <td><?php echo $curUser->city;?></td>
            <td><?php echo $curUser->state;?></td>
            <td><?php echo $curUser->zipCode;?></td>
            <td><?php echo $curUser->homePhone;?></td>
            <td><?php echo $curUser-> cellPhone;?></td>
        </tr>
<?php } ?>
</table>
<?php
 //Step 4
$dbh->close();
 ?>

 <script>
     $( function() {
         var availableTags = <?php echo json_encode($userSearchIndex);?>;
         $( "#searchUser" ).autocomplete({
             source: availableTags
         });
     } );
 </script>
 <script>
     var input = document.getElementById("searchUser");
     input.addEventListener("keyup", function(event) {
         event.preventDefault();
         if (event.keyCode === 13) {
             var name = document.getElementById("searchUser").value;
             var uids = <?php echo json_encode($userSearchMap); ?>;
             var uid = uids[name];
             window.location.href = "ShowCustomer.php?uid=" + uid;
         }
     });
 </script>

</body>
</html>