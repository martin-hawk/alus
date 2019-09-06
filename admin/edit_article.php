<?php
include 'includes/functions.php';
page_protect('1 2');

if (isset($_POST['update'])) {
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	mysqli_set_charset($conn,"utf8");
			
	$title = $conn->real_escape_string($_POST['title']);
	$content = $conn->real_escape_string($_POST['content']);
	
    $sql = "UPDATE contents SET title = '$title', content = '$content' WHERE id = " . $_GET['id'];
		
		$conn->query($sql);
		$msg = 'Duomenys išsaugoti sėkmingai!';
		$conn->close();
} else $error = 'Kažkur yra klaida!';
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
<section class="section-style w3-text-orange" style="width:66%;">
  <?php
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT * FROM contents WHERE id = " . $_GET['id'];
	$result = $conn->query($sql);

	$row = $result->fetch_assoc();

	$conn->close();
	?>
  <h3 style="border-bottom:solid thin #FF9800;">Taisyti įrašą</h3>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <table class="w3-table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="text-align:left;"><label for="title">Antraštė:</label></td>
        <td style="text-align:left;"><input type="text" name="title" size="32" value="<?php echo $row['title']; ?>"></td>
        <td align="center" valign="bottom"><input type="submit" class="w3-btn w3-light-grey" name="update" value="Atnaujinti"></td>
      </tr>
    </table>
    <label for="content">Turinys:</label>
    <textarea name="content" id="content"><?php echo htmlspecialchars_decode(stripslashes($row['content'])) ?></textarea>
    <script>
	  	CKEDITOR.replace('content');
      </script>
  </form>
</section>
<footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016
  <?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>
  . Sprendimas: <a href="http://martinhawk.co.uk">Martin Hawk</a></footer>
</body>
</html>