<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/20/18
 * Time: 8:51 PM
 */

include 'db_connnection.php';
include 'lib/Cookies.php';

session_start();

$conn = OpenCon();

$msg = "hmmm!";

if(isset($_POST['email']) AND isset($_POST['psw'])) {
    $query = "SELECT firstName, lastName, emailAddress, groupID, password FROM Roncabeanz.User WHERE emailAddress='{$_POST['email']}' ";
    $result = mysqli_query($conn, $query) or die("The email or password you entered is not valid");

    $fields = mysqli_fetch_fields($result);

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $pwd = $_POST['psw'];
    $cpwd = $_POST['psw_c'];

    $row = mysqli_fetch_array($result);

    $ref = $_SESSION['ref'];
    $pathParts = explode("/", $ref);
    $page = end($pathParts);


    if($row == null && $pwd == $cpwd)
    {
        $add = "INSERT INTO Roncabeanz.User (firstName, lastName, emailAddress, groupID, password) VALUES('$fname', '$lname', '$email', 'Customer', '$pwd')";

        if ($conn->query($add) != TRUE) {
            $msg += "Error: " + $add + "<br>" + $conn->error;
        }
        else {
            $hdr = "Location: $page";
            header($hdr);
        }
    }
    else if($pwd != $cpwd)
    {
        $msg = "Passwords do not match";
    }
    else
    {
        $msg = "Account already exists";
        $msg = "Account already exists";
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>


</head>
<body >

    <?php echo($page); ?>
    <?php echo($msg); ?>
</body>
</html>

<?php
//Step 4
CloseCon($conn);
?>

