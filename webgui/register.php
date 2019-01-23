<?php include('server.php') ?>

<?php
include 'login_test.php';  // Funktioniert
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registrieren</title>
  <link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>
  <div class="header">
  	<h2>Registrieren</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Benutzername</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Passwort</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Passwort wiederhohlen</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Admin anlegen!</button>
  	</div>
  	<p>
  		Willst du dich <a href="login.php">Einloggen</a>?
  	</p>
  </form>
</body>
</html>
