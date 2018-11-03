
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>About Page template By Adobe Dreamweaver CC</title>
<link href="css/aboutPageStyle.css" rel="stylesheet" type="text/css">
<link href="css/Header.css" rel="stylesheet" type="text/css">

<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
</head>

<body>
<?php
    session_start();
    $_SESSION['ref'] = $_SERVER['SCRIPT_NAME'];
    session_write_close();

?>

<!-- Header content -->
<?php include 'Header.php'; ?>


<div class="row">

</div>

<!-- content -->
<div class="row">
    <h2>About Us</h2>
</div>

<!-- Header content -->
    <hr>
    <p align="left">At Roncabeanz, we love coffee. Not the bitter coffee that most people drink, but fresh coffee made from beans that close to the roast (2 weeks, max). We obsess over the quality and flavor of a great coffee. One with hints of chocolate and fruits, and never bitter</p>
  </div>

<!-- content -->


<footer>
  <hr>
  <p class="footerDisclaimer">2018  Copyrights - <span>All Rights Reserved</span></p>
</footer>
</body>
</html>
