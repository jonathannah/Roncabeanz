<?php

include_once 'lib/CurlHelper.php';

$uToken = htmlspecialchars($_GET["userToken"]);

if($uToken == "")
{
    $retAddr = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    $hdr = "Location: http://teamalphamarket.com/TeamAlphaMarket/GetCurrentUserToken.php?retAddr=".$retAddr;

    header($hdr);
}

$ch = new CurlHelper();
$result = $ch->get("http://teamalphamarket.com/TeamAlphaMarket/ReadUserInfo.php?userToken=".$uToken);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php echo "User Token: ", $uToken; ?>
<br>
<?php echo $result; ?>

</body>
</html>