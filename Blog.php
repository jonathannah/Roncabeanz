

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BlogPost template by Adobe Dreamweaver CC</title>
	<button type="button" onclick="javascript:history.back()">Back</button>
<link href="css/blogPostStyle.css" rel="stylesheet" type="text/css">
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

<div id="main">
  <header> 
    <!--**************************************************************************
    Header starts here. It contains Logo and 3 navigation links. 
    ****************************************************************************-->

       <?php include 'Header.php'; ?>
  </header>
  <div id="content">
    <div class="notOnDesktop"> 
      <!-- This search box is displayed only in mobile and tablet laouts and not in desktop layouts -->
      <input type="text" placeholder="Search">
    </div>
    <section id="mainContent" >
      <!--************************************************************************
    Main Blog content starts here
    ****************************************************************************-->
      <h1><!-- Blog title --><span data-dobid="hdw">Coffee Stock·holm Syn·drome</span></h1>
      <h3><!-- Tagline --><em>noun</em> ß</h3>
      <h3>believing that coffee is supposed to be harsh and bitter coffee because that is the way it always tasted.</h3>
      <div id="bannerImage"><img src="images/CoffeeBeans.jpg" alt="" height="231"/>
      <div >
        <p>&nbsp;</p>
        <aside id="authorInfo"> 
          <!-- The author information is contained here -->
          <h2>David Ronca</h2>
          <p >I am a  coffee drinker, and I take my coffee black. Always have, though I often wonder why. Because black coffee is harsh and bitter. I suppose, like cigarette smokers, the caffene addiction overpowers your body's natural reaction to bad tastes and smells. Anyway, tht's just the way it is.  If you want to drink black coffee, you will grimace the taste, and your friends will grimace at your coffee breath.  I call it the Coffee Stockholm Syndrom. Over time, I actually grew to like the bad coffee.  Or at least I thought I did.</p>
          <p>But what if I told you it did not have to be this way?  Black coffee, made from quality fresh-roasted beans, is not bitter or harsh.  On the contrary, drinking quality coffee is like drinking a a fine wine.  Your tastebuds marvel at the smooth and sweet flavor.  You taste hints of chocolate, and citrus, and even cinamon.  Yes, fresh-roasted coffee is a treat.  Try it!  </p>
          <p>Next up:  It's All About the Beans!</p>
        </aside>
      </div>
      </div>
    </section>

    </section>

  </div>
 </body>
</html>

