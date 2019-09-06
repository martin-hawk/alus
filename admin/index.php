<?php
$configs = include '../config.php';
	// Create connection
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	mysqli_set_charset($conn,"utf8");

if (isset($_POST['Login'])) {
	if ($_POST['username'] != '' && $_POST['password'] != '') {
		$username = $conn->real_escape_string($_POST['username']);
		$password = $conn->real_escape_string($_POST['password']);
		
		$sql = "SELECT * FROM users WHERE username = '$username'";
		
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		if (hash_hmac("sha256", $password, $row['salt']) === $row['password']) {
				session_start();
				
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['user'] = $_POST['username'];
                $_SESSION['logged_in'] = true;
                $_SESSION['access_level'] = $row['access_level'];
                $_SESSION['f_name'] = $row['first_name'];
                $_SESSION['l_name'] = $row['last_name'];
				$_SESSION['email'] = $row['email'];
				header("Location: main.php");
	} else $error = 'Nepavyko prisijungti!';
} else $error = 'Prašome nurodyti vartotojo vardą ir slaptažodį.';
}

$conn->close();
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
    <h3 style="border-bottom:solid thin #FF9800;">Prisijungti prie administratoriaus srities</h3>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="logForm">
      <table class="w3-table" border="0" cellpadding="4" cellspacing="4">
        <tr>
          <td colspan="2" style="text-align:left;"><div class="error">
              <?php if (isset($error)) { echo $error; } ?>
            </div></td>
        </tr>
        <tr>
          <td style="text-align:left;">Vartotojas</td>
          <td style="text-align:left;"><input name="username" type="text" size="32" /></td>
        </tr>
        <tr>
          <td style="text-align:left;">Slaptažodis</td>
          <td style="text-align:left;"><input name="password" type="password" size="32" /></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
              <input name="Login" class="w3-btn w3-light-grey" type="submit" value="Prisijungti" />
            </div></td>
        </tr>
      </table>
    </form>
  </section>
  <footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016
  <?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>
  . Sprendimas: <a href="http://martinhawk.co.uk">Martin Hawk</a></footer>
</div>
</body>
</html>