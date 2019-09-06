<?php
include 'includes/functions.php';
page_protect('1 2');
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

	// Create connection
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 5; // Set how many records do you want to display per page.
 
$startpoint = ($page * $per_page) - $per_page;

mysqli_set_charset($conn,"utf8");

$statement = "beers";
  
$results = mysqli_query($conn,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");

if (mysqli_num_rows($results) != 0) {
    while($row = $results->fetch_assoc()) {
		$helper_sql = "SELECT id, name FROM brewers WHERE id = " . $row['brewer_id'];
		$helper_results = mysqli_query($conn, $helper_sql);
		$helper_row = $helper_results->fetch_assoc(); 
		if ($helper_row['id'] == $row['brewer_id']) echo '<article><a href="edit_beer.php?id=' . $row['id'] . '"><h3>' . $row['name'] . '</h3></a><br>Gamintojas: ' . $helper_row['name'] . '</article><hr noshade>';
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