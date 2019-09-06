<?php
include 'includes/functions.php';
page_protect('1 2');

if (isset($_POST['update'])) {
	if ($_POST['password'] != '' && $_POST['password'] == $_POST['password_confirmed']) {
			
			$configs = include '../config.php';

			$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
			mysqli_set_charset($conn,"utf8");
			
			$salt = uniqid(mt_rand(), true);
			$password = hash_hmac("sha256", $conn->real_escape_string($_POST['password']), $salt);
			$firstname = $conn->real_escape_string($_POST['firstname']);
			$lastname = $conn->real_escape_string($_POST['lastname']);
			
			if (isset($_GET['id']))  $id = $_GET['id'];
			else $id = $_SESSION['user_id'];

        $sql = "UPDATE users SET password = '$password', salt = '$salt', first_name = '$firstname', last_name = '$lastname' WHERE id = '$id'";
		
		$conn->query($sql);
		$msg = 'Duomenys sėkmingai pakeisti!<br>Kad pakeitimai įsigaliotų, prašome <div style="text-align:center"><a href="logout.php">prisijungti iš naujo.</a>';
		$conn->close();
} elseif ($_POST['email'] != '' && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true)) {
			$configs = include '../config.php';

			$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
			mysqli_set_charset($conn,"utf8");
			
			$firstname = $conn->real_escape_string($_POST['firstname']);
			$lastname = $conn->real_escape_string($_POST['lastname']);
			$email = $conn->real_escape_string($_POST['email']);
			
			if (isset($_GET['id']))  $id = $_GET['id'];
			else $id = $_SESSION['user_id'];

        $sql = "UPDATE users SET first_name = '$firstname', last_name = '$lastname', email = '$email' WHERE id = '$id'";
		
		$conn->query($sql);
		$msg = 'Duomenys sėkmingai pakeisti!<br>Kad pakeitimai įsigaliotų, prašome <div style="text-align:center"><a href="logout.php">prisijungti iš naujo.</a>';
		$conn->close();
		
	} else $error = 'Kažkur yra klaida!';
}
if (isset($_POST['delete']) == 'Ištrinti') {
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	mysqli_set_charset($conn,"utf8");
	
	$sql = "DELETE FROM users WHERE id = '" . $_GET['id'] . "'";
	$conn->query($sql);
	
	$errors['success'] = 'Vartotojas buvo sėkmingai ištrintas!';
	
	$conn->close();
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
<script src="ckeditor/ckeditor.js"></script>
</head>
<body class="w3-orange  w3-centered">
<header class="w3-container w3-text-white header-style">
  <div class="w3-container flagBack"> <?php echo 'Vartotojas: ';
    if (is_null($_SESSION["f_name"])) echo 'Neįvestas vardas '; else echo $_SESSION["f_name"] . ' ';
	if (is_null($_SESSION["l_name"])) echo 'Neįvesta pavardė'; else echo $_SESSION["l_name"]; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php" class="w3-btn w3-light-grey">Atsijungti</a></div>
  <h1>AlusLT - paragauk tikro...</h1>
</header>
<?php include 'menu.php'; ?>
<section class="section-style w3-text-orange" style="width:33%;">
  <h3 style="border-bottom:solid thin #FF9800;">Vartotojo duomenys</h3>
   <div class="errorMessage">
    <?php if (isset($errors)) {
		if (isset($errors['isImage'])) echo $errors['isImage'] . '<br>';
		if (isset($errors['dimensions'])) echo $errors['dimensions'] . '<br>';
		if (isset($errors['alreadyExists'])) echo $errors['alreadyExists'] . '<br>';
		if (isset($errors['format'])) echo $errors['format'] . '<br>';
		if (isset($errors['isOk'])) echo $errors['isOk'] . '<br>';
		if (isset($errors['uploadError'])) echo $errors['uploadError'] . '<br>';
		if (isset($errors['success'])) echo $errors['success'];
	} ?>
  </div>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <table class="w3-table" border="0" cellpadding="4" cellspacing="4">
	<?php
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT * FROM users WHERE id = " . $_GET['id'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	?>
      <tr>
        <td colspan="2" style="text-align:left;">Vartotojo vardas</td>
        <td style="text-align:left;"><?php echo $row['username']; ?></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left;">Vardas</td>
        <td style="text-align:left;"><input type="text" name="firstname" size="32" value="<?php echo $row['first_name']; ?>" /></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left;">Pavardė</td>
        <td style="text-align:left;"><input type="text" name="lastname" size="32" value="<?php echo $row['last_name']; ?>" /></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left;">Slaptažodis</td>
        <td style="text-align:left;"><input type="password" name="password" size="32" value="" /></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left;">Slaptažodis (pakartoti)</td>
        <td style="text-align:left;"><input type="password" name="password_confirmed" size="32" value="" /></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left;">El. paštas</td>
        <td style="text-align:left;"><input type="text" name="email" size="32" value="<?php echo $row['email']; ?>" /></td>
      </tr>
      
        <td align="center" colspan="3"><input type="submit" class="w3-btn w3-light-grey" name="update" value="Atnaujinti" />&nbsp;&nbsp;&nbsp;<input type="submit" class="w3-btn w3-red" name="delete" value="Ištrinti">
          <p>Jeigu nenorite keisti slaptažodžio - palikite laukelius tuščius.</p></td>
        <?php
		  $conn->close();
?>
    </table>
  </form>
</section>
<footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016
  <?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>
  . Sprendimas: <a href="http://martinhawk.co.uk">Martin Hawk</a></footer>
</body>
</html>