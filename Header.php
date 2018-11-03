<?php

include_once "Cookies.php";

include_once 'lib/DBHelper.php';

include_once './lib/ShoppingCart.php';

$dbh_hdr = new DBHelper();

session_start();
$shoppingCart = $_SESSION[SHOPPING_CART];
session_write_close();

?>


    <div class="form-popup" id="loginForm" align="center" >
        <form action="Login.php" method="post" class="form-container">
            <h1>Login</h1>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" class="btn">Login</button>
            <button type="button" class="btn cancel" onclick="closeLoginForm()">Close</button>
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

    <script>
        function emptyCart(){


            document.getElementById("shoppingCartMenu").contentWindow.location.reload(true);
        }
    </script>
    <div >

    <script type="text/javascript">
        function confirmPass() {
            var pass = document.getElementById("psw").value
            var confPass = document.getElementById("psw_c").value
            if(pass != confPass) {
                alert('Wrong confirm password !');
            }
        }
    </script>

    <div class="form-popup" id="createAccountForm" align="center" >
        <form action="CreateAccount.php" method="post" class="form-container">
            <h1>Login</h1>

            <label for="firstName"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="firstName" required>
            <label for="lastName"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lastName" required>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <label for="psw_c"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="psw_c" onblur="confirmPass()" required>

            <button type="submit" class="btn">Create Account</button>
            <button type="button" class="btn cancel" onclick="closeLoginForm()">Close</button>
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
            switch(dropdown.value {
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

    <div id="green"><img src="images/CoffeeIcon.jpg" alt="" width="134" height="94" fontSize="100" align="left"/></div>
        <div id="red">
            <h1>
                <?php
                    if(stripos($fileList[0], "RoncabeanzMain.php", 0) == false){
                        echo '<a href="RoncabeanzMain.php">Roncabeanz</a>';
                    }
                    else{
                        echo 'Roncabeanz';
                    }
                ?>
            </h1>
            <h2>We simply respect the beans!</h2>
        </div>
    <div id="blue">
    <?php

    if(isset($_COOKIE[COOKIE_NAME])) {
        $user = $_COOKIE[COOKIE_NAME];
    } else {
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
                }
                else {
                    echo '<a href="ShowPurchases.php">Order History</a>';
                }
                ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="dropdown">
            <button class="dropbtn">Login/Sign-up</button>
            <div id="notLoggedInOpts" class="dropdown-content" >
                <a href="#" onClick="openLoginForm()">Login</a>
                <a href="#" onClick="openCreateAccountForm()">Create Account</a>
            </div>
        </div>
    <?php } ?>
        <div class="dropdown" id="shoppingCartMenu">
            <input class="dropcartbtn" type="image" src="images/ShoppingCartIcon.png" width="70" height="60"></input>
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
</div>

<?php $dbh_hdr->close(); ?>
