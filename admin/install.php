<?php
if (isset($_POST['register'])) {
	if ($_POST['username'] != '' && $_POST['password'] != '' && $_POST['password'] == $_POST['password_confirmed'] && $_POST['email'] != '' && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true)) {
			
			$configs = include '../config.php';

			$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
			mysqli_set_charset($conn,"utf8");
			
			$username = $conn->real_escape_string($_POST['username']);
			$firstname = $conn->real_escape_string($_POST['firstname']);
			$lastname = $conn->real_escape_string($_POST['lastname']);
			$email = $conn->real_escape_string($_POST['email']);
			$salt = uniqid(mt_rand(), true);
			$password = hash_hmac("sha256", $conn->real_escape_string($_POST['password']), $salt);

        $sql = "INSERT INTO users (`username`, `password`, `salt`, `first_name`, `last_name`, `email`, `access_level`) VALUES ('$username', '$password', '$salt', '$firstname', '$lastname', '$email', 1)";
		
		$conn->query($sql);
		$msg = 'Administratorius užregistruotas!<br>Nepamirškite ištrinti <b>/admin/install.php</b> iš serverio!';
		$conn->close();
} else $error = 'Kažkur yra klaida!';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AlusLT - paragauk tikro...</title>
<link rel="shortcut icon" href="../favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="css/back.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body class="w3-orange  w3-centered">
  <header class="w3-container w3-text-white header-style">
    <h1>AlusLT - paragauk tikro...</h1>
  </header>
  <section class="section-style w3-text-orange" style="width:33%;">
    <h3 style="border-bottom:solid thin #FF9800;">Administratoriaus Registracija</h3>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="w3-responsive">
      <table class="w3-table" border="0" cellpadding="4" cellspacing="4">
        <tr>
          <td colspan="4"><?php if (isset($error)) { echo '<div class="error">' . $error . '</div>';
}
if (isset($msg)) { echo '<div class="infomsg">' . $msg . '</div>'; } else { ?></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:left;">Vartotojo vardas *</td>
          <td style="text-align:left;"><input type="text" name="username" size="32" value="<?php if (isset
    ($_POST['username'])) { echo $_POST['username']; } ?>" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:left;">Vardas</td>
          <td style="text-align:left;"><input type="text" name="firstname" size="32" value="<?php if (isset
    ($_POST['firstname'])) { echo $_POST['firstname']; } ?>" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:left;">Pavardė</td>
          <td style="text-align:left;"><input type="text" name="lastname" size="32" value="<?php if (isset
    ($_POST['lastname'])) { echo $_POST['lastname']; } ?>" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:left;">Slaptažodis *</td>
          <td style="text-align:left;"><input type="password" name="password" size="32" value="" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:left;">Slaptažodis (pakartoti) *</td>
          <td style="text-align:left;"><input type="password" name="password_confirmed" size="32" value="" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:left;">El. paštas *</td>
          <td style="text-align:left;"><input type="text" name="email" size="32" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; }?>" /></td>
        </tr>
        
          <td align="center" colspan="3"><input class="w3-btn w3-light-grey" type="submit" name="register" value="Užregistruoti" /></td>
          <?php } echo '<tr><td align="center" colspan="3"><a href="index.php">Prisijungti</a></td></tr>'; ?>
      </table>
      </div>
    </form>
  </section>
  <footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016
  <?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>
  . Sprendimas: <a href="http://martinhawk.co.uk">Martin Hawk</a></footer>
</body>
</html>