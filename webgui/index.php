<?php
include 'login_test.php';  // Funktioniert
?>


<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Navigation</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="style/cookies.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }

/* Responsive Full Background Image Using CSS * Tutorial URL: http://sixrevisions.com/css/responsive-background-image/*/body {  /* Location of the image */  background-image: url(hintergrund.jpg);    /* Image is centered vertically and horizontally at all times */  background-position: center center;    /* Image doesn't repeat */  background-repeat: no-repeat;    /* Makes the image fixed in the viewport so that it doesn't move when      the content height is greater than the image height */  background-attachment: fixed;    /* This is what makes the background image rescale based on its container's size */  background-size: cover;    /* Pick a solid background color that will be displayed while the background image is loading */  background-color:#464646;    /* SHORTHAND CSS NOTATION   * background: url(background-photo.jpg) center center cover no-repeat fixed;   */}/* For mobile devices */@media only screen and (max-width: 767px) {  body {    /* The file size of this background image is 93% smaller     * to improve page load speed on mobile internet connections */    background-image: url(hintergrund.jpg);  }	}

</style>
</head> 
<body>
<div class="bs-example">
    <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Men&uuml;</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                
       		<li><a href='event-anlegen.php'>Event anlegen</a></li>
       		<li><a href='event-exportieren.php'>Event Exportieren</a></li>
       		<li><a href='event-loeschen.php'>Event l&ouml;schen</a></li>
       		<li><a href='anhang.php'>Event Anhang hinzuf&uuml;gen</a></li>
       		<li><a href='offen.php'>Offene Einladungen</a></li>
       		<li><a href='bestaetigung.php'>Hash eingeben</a></li>
        	<!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">User aktionen<span class="caret"></span></a>-->
            		<li><a href='user-anlegen.php'>User anlegen</a></li>
            		<li><a href='user-loeschen.php'>User l&ouml;schen</a></li>
            		<li role="separator" class="divider"></li>
            		<li><a href='register.php'>Admin anlegen</a></li>
            		<li><a href='admin-loeschen.php'>Admin l&ouml;schen</a></li>
        	<!--</li>-->
		
       		<li><a href='datenschutz.html'>Datenschutzerkl&auml;rung</a></li>
       		<li><a href='impressum.html'>Impressum</a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
    		<li><a href="index.php?logout='1'">Ausloggen</a></li>
            </ul>
        </div>
    </nav>
</div>

<div id="cookiedingsbums">
<div id="cookiedingsbums_vintage"><div>
<div id="cookieinhalt">
<span>Ja, auch diese Webseite verwendet Cookies. </span>
<a href="http://xxx.euredomain.de/euredatenschutzseite">
Hier erfahrt ihr alles zum Datenschutz.</a></div>
 <span id="cookiedingsbumsCloser" onclick="document.cookie = 'hidecookiedingsbums=1;path=/';jQuery('#cookiedingsbums').slideUp()">&#10006;</span>
</div>
<script>
 if(document.cookie.indexOf('hidecookiedingsbums=1') != -1){
 jQuery('#cookiedingsbums').hide();
 }
 else{
 jQuery('#cookiedingsbums').prependTo('body');
 jQuery('#cookiedingsbumsCloser').show();
 }
</script>


</body>
</html>                            
