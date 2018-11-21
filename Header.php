
<?php
include_once "lib/Cookies.php";
include_once 'lib/DBHelper.php';
include_once './lib/ShoppingCart.php';
include_once 'lib/User.php';

$dbh_hdr = new DBHelper();
session_start();

if($_SESSION[SHOPPING_CART] == null) {
    $_SESSION[SHOPPING_CART] = new ShoppingCart();
}
$shoppingCart = $_SESSION[SHOPPING_CART];
session_write_close();

$uToken = htmlspecialchars($_GET["userToken"]);
$mktUser = null;
if($uToken != ""){
    $mktUser = User::fromToken($uToken);
}

?>


<div id="id01" class="modal">

    <form class="modal-content animate" action="Login2.php">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="images/CoffeeIcon.png"  alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>

<div class="form-popup" id="loginForm" align="center" >
    <form action="Login2.php"  class="form-container">
        <h1>Login</h1>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <input type="submit" class="btn" value="Login">
        <input type="button" class="btn cancel" onclick="closeLoginForm()" value="Close">
    </form>
</div>


<script>
    function openLoginForm() {
        document.getElementById("loginForm").style.display = "block";
    }
    function closeLoginForm() {
        document.getElementById("loginForm").style.display = "none";
    }
</script>


<script type="text/javascript">
    function confirmPass() {
        var pass = document.getElementById("psw").value;
        var confPass = document.getElementById("psw_c").value;
        if(pass !== confPass) {
            alert('Wrong confirm password !');
        }
    }
</script>

<div class="form-popup" id="createAccountForm" align="center" style="width: 100%">
    <form action="CreateAccount.php" method="post" class="form-container" style="width: 100%">
        <h1>Login</h1>

        <tr c>
            <td >
                <input type="text" placeholder="Enter First Name" placeholder="First Name" name="firstName" required >
            </td>
            <td >
                <input type="text" placeholder="Enter Last Name" placeholder="Last Name" name="lastName" required>
            </td>
        </tr>
        <div></div>
        <input type="text" placeholder="Enter Email" name="email" required>
        <input type="text" placeholder="Enter Address" name="addr" required>
        <input type="text" placeholder="Apartment" name="apt" >
        <input type="text" placeholder="City" name="city" required>
        <input type="text" placeholder="State" name="state" required>
        <input type="text" placeholder="Zipcode" name="zip" required>
        <input type="text" placeholder="Home Phone" name="phone" required>
        <input type="text" placeholder="Cell Phone" name="cellPhone" required>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <input type="password" placeholder="Confirm Password" name="psw_c" onblur="confirmPass()" required>

        <input type="submit" class="btn" value="Create Account">
        <input type="button" class="btn cancel" onclick="closeCreateAccountForm()" value="Close">
    </form>
</div>


<script>
    function openCreateAccountForm() {
        document.getElementById("createAccountForm").style.display = "block";
    }
    function closeCreateAccountForm() {
        document.getElementById("createAccountForm").style.display = "none";
    }
</script>

    <script>
        function handleHelloMenu() {
            openCreateAccountForm();
            var dropdown = document.getElementById("notLoggedInOpts");
            switch(dropdown.value) {
                case 0:
                    openLoginForm();
                    break;
                case 1:
                    openCreateAccountForm();
                    break;
            }
        }
    </script>
    <?php $fileList = get_included_files();?>
    <thumbnail><img class="thumbNail" src="images/CoffeeIcon.png" alt="" align="left"/></thumbnail>
    <logo>
        <hd1>
            <?php
            if(stripos($fileList[0], "RoncabeanzMain.php", 0) == false){
                echo '<a href="RoncabeanzMain.php">Roncabeanz</a>';
            }
            else{
                echo 'Roncabeanz';
            }
            ?>
            <br>
        </hd1>
        <hd2>We simply respect the beans!</hd2>
    </logo>

    <topMenus>
        <?php
        if($mktUser != null){
            $user = $mktUser->fname;
        }
        else if(isset($_COOKIE[COOKIE_NAME])) {
            $user = $_COOKIE[COOKIE_NAME];
        }
        else {
            $user = "";
        }
        if($user != "") {
            $query = "SELECT firstName, lastName, emailAddress, groupID FROM Roncabeanz.User WHERE emailAddress='{$_COOKIE[COOKIE_EMAIL]}' ";
            $result = $dbh_hdr->query($query);
            $row = mysqli_fetch_array($result);
            $isAdmin = $row["groupID"] == "Administrator";
            ?>
            <div class="dropdown">
                <button class="dropbtn">Hello <?php echo $user; ?></button>
                <div class="dropdown-content">
                    <a href="LogOff.php">Log Out</a>
                    <?php
                    if($isAdmin){
                        echo '<a href="ShowCustomers.php">Mangage Customers</a>';
                        echo '<a href="ManageFeedback.php">Mangage Customer Feedback</a>';
                        echo '<a href="ManageProducts.php">Mangage Products</a>';
                        echo '<a href="TeamInteropTest.php?feedName=RoncabeanzUser&feedUri=http%3A%2F%2Froncabeanz.com%2FRoncabeanz%2FReadUsers.php">Marketplace Customers</a>';
                    }
                    else {
                        echo '<a href="ShowPurchases.php">Order History</a>';
                    }
                    ?>
                </div>
            </div>
        <?php } else {
            $retUrl = "http://roncabeanz.com/Roncabeanz/RoncabeanzMain.php";
            ?>
            <div class="dropdown">
                <button class="dropbtn">Login/Sign-up</button>
                <div id="notLoggedInOpts" class="dropdown-content" >
                    <a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a>
                    <a href="#" onClick="openCreateAccountForm()">Create Account</a>
                    <a href="http://34.213.186.3/TeamAlphaMarket/GetCurrentUserToken.php?retAddr=<?php echo $retUrl;?>">Login Using TAM</a>
                </div>
            </div>
        <?php } ?>
        <div class="dropdown" id="shoppingCartMenu">
            <input class="dropcartbtn" type="image" src="images/ShoppingCartIcon.png" width="70" height="60">
            <div class="dropdown-content">
                <?php
                $cartEmpty = true;
                if($shoppingCart != null){
                    $cartEmpty = $shoppingCart->isEmpty();
                }
                if(!$cartEmpty){
                    echo '<a href="ShowCart.php">View</a>';
                    echo '<a href="EmptyCart.php">Empty</a>';
                }
                ?>
            </div>
        </div>
    </topMenus>

    <?php $dbh_hdr->close(); ?>

