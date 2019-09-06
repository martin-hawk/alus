<?php
include 'includes/functions.php';
page_protect('1');
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
	include '../pagination.php';
	$configs = include ('../config.php');

	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 5; // Set how many records do you want to display per page.
 
$startpoint = ($page * $per_page) - $per_page;

mysqli_set_charset($conn,"utf8");

$statement = "users ORDER BY id ASC";
  
$results = mysqli_query($conn,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
 
if (mysqli_num_rows($results) != 0) {
    while($row = $results->fetch_assoc()) {
		if ($row['access_level'] == 1) $level = 'Administratorius';
		else $level = 'Vartotojas';
		
		echo '<a href="edit_user.php?id=' . $row['id'] . '"><h3>' . $row['username'] . '</h3></a><div>' . $row['first_name'] . ' ' . $row['last_name'] . ' | ' . $row['email'] . ' | ' . $level . '</div>' . '<hr noshade>';
    } 
}

$conn->close();

 // displaying paginaiton.
echo pagination($statement,$per_page,$page,$url='?');
	?>
</section>
<footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016
  <?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>
  . Sprendimas: <a href="http://martinhawk.co.uk">Martin Hawk</a></footer>
</body>
</html>