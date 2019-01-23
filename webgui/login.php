<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Einloggen</title>
  <link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>
  <div class="header">
  	<h2>Einloggen</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Benutzername</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Passwort</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Einloggen</button>
  	</div>
  	<p>
  		<!-- VERBOTEN M&ouml;chtest du dich <a href="register.php">registrieren</a>? -->
  	</p>
  </form>
</body>
</html>
