
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/Header.css" rel="stylesheet" type="text/css">
    <link href="css/roncabeanz_style.css" rel="stylesheet" type="text/css">

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

    <div class="content">

    <div class="row">
        <h2>Contact Us</h2>
    </div>
        <div class="row">
        <form name="contactform" method="post" action="CollectContactInfo.php">
            <table width="450px">
            <tr>
             <td valign="top">
              <label for="first_name">First Name *</label>
             </td>
             <td valign="top">
              <input  type="text" name="first_name" maxlength="50" size="30">
             </td>
            </tr>
            <tr>
             <td valign="top">
              <label for="last_name">Last Name *</label>
             </td>
             <td valign="top">
              <input  type="text" name="last_name" maxlength="50" size="30">
             </td>
            </tr>
            <tr>
             <td valign="top">
              <label for="email">Email Address *</label>
             </td>
             <td valign="top">
              <input  type="text" name="email" maxlength="80" size="30">
             </td>
            <tr>
             <td valign="top">
              <label for="comments">Comments *</label>
             </td>
             <td valign="top">
              <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
             </td>
            </tr>
            <tr>
             <td colspan="2" style="text-align:center">
              <input type="submit" value="Submit">
             </td>
            </tr>
            </table>
        </form>

        </div>

    </div>
</body>
</html>


