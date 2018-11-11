<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/10/18
 * Time: 5:21 PM
 */

include_once 'lib/CurlHelper.php';

$siteName = htmlspecialchars($_GET["feedName"]);
$siteUri= utf8_decode($_GET["feedUri"]);

class TeamEndPoints
{
    public $name;
    public $requestUrl;

    public function __construct($name, $requestUrl)
    {
        $this->name = $name;
        $this->requestUrl = $requestUrl;
    }
}

$userServers = array(
    //new TeamEndPoints("The Beanz Users", "http://roncabeanz.com/Roncabeanz/ReadUsers.php"),
    //new TeamEndPoints("The Beanz Products", "http://roncabeanz.com/Roncabeanz/ReadProducts.php")
    new TeamEndPoints($siteName, $siteUri)
);

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
 <div class="container">
    <?php include 'Header.php'; ?>
  </div>
 <div class="row"></div>
 <h1>Marketplace Customers</h1>

 <?php
    foreach ($userServers as $cur) {
        $ch = new CurlHelper();
        $result = $ch->get($cur->requestUrl);

        $users = json_decode($result, TRUE);
        $fieldNames = array_keys($users[0]);
        ?>
        <br>
        <h2><?php echo $cur->name; ?></h2>


        <table>
            <tr>
                <?php
                foreach($fieldNames as $fdname){
                    echo '<th>',$fdname,'</th>';
                }
                ?>
            </tr>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <?php
                        foreach($fieldNames as $fdname){
                            echo '<td>',$user[$fdname],'</td>';
                        }
                    ?>
                </tr>
                <?php
            }

            ?>
        </table>
        <?php
    } ?>
 ?>

</body>
</html>

