<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AlusLT - paragauk tikro...</title>
<link rel="shortcut icon" href="favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
<header class="w3-container w3-center"><img src="images/banner.png" width="100%"></header>
<nav>
  <ul class="w3-navbar w3-center menu-style">
    <li style="width:33%"><a href="main.php?id=1">Apie AlusLT</a></li>
    <li style="width:34%"><a href="main.php?id=b">Alaus gamintojai</a></li>
    <li style="width:33%"><a href="main.php?id=2">Kontaktai</a></li>
  </ul>
</nav>
<div class="w3-container container-style">
  <section class="section-style">
    <article class="w3-container w3-large w3-text-white w3-justify article-style">
      <?php
	if (isset($_GET['id']) && is_numeric($_GET['id']) == true) {
		
	$configs = include 'config.php';

	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	mysqli_set_charset($conn, "utf8");
	$sql = "SELECT * FROM contents WHERE id = " . $_GET['id'];
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
	    	echo '<article><div>' . htmlspecialchars_decode(stripslashes($row['content'])) . '</div></article>';
    	}
	}
	$conn->close();
	}
	else {
		if (isset($_GET['bid'])) {
			$configs = include 'config.php';

			$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);

			if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
		} 
			mysqli_set_charset($conn, "utf8");
			$sql = "SELECT * FROM beers WHERE active = 1 AND brewer_id = '" . $_GET['bid'] . "'";
			$result = $conn->query($sql);
		
			echo '<div class="w3-row-padding w3-margin">';

			if ($result->num_rows > 0) {
    			// output data of each row
    			while($row = $result->fetch_assoc()) {
					echo '<div class="w3-quarter w3-center">';
						echo '<div class="w3-card-2 w3-margin-8"> <img src="' . $row['image'] . '" width=100%>';
							echo '<div class="w3-container">';
								if ($row['show_name'] == true) echo '<div style="font-size:26px;font-weight:bold">' . $row['name'] . '</div>';
								if ($row['show_description'] == true) {
									echo '<button class="button-link" onclick="document.getElementById(' . "'" . $row['id'] . "'". ').style.display=' . "'block'" . '">Rodyti aprašymą...</button>';
									echo '<div id="' . $row['id'] . '" class="description-container" style="text-align:left; display:none;">';
									echo '<span onclick="this.parentElement.style.display=' . "'none'". '" class="w3-closebtn">x</span>';
									echo $row['description'] . '</div></div></div></div>';}
								else echo '</div></div></div>'; 
    			}
			}
			$conn->close();		
			}
		else {
			$configs = include 'config.php';

			$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);

			if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
		} 
			mysqli_set_charset($conn, "utf8");
			$sql = "SELECT * FROM brewers";
			$result = $conn->query($sql);
		
			echo '<div class="w3-row-padding w3-margin w3-small">';

			if ($result->num_rows > 0) {
    			// output data of each row
    			while($row = $result->fetch_assoc()) {
					echo '<div class="w3-quarter w3-center">';
						echo '<div class="w3-card-2 w3-margin-8"> <a href="main.php?bid=' .$row['id'] . '"> <img src="' . $row['image'] . '" width=100%></a>';
							echo '<div class="w3-container">';
								if ($row['show_name'] == true) echo '<h4>' . $row['name'] . '</h4>';
								if ($row['show_description'] == true) echo $row['description'] . '</div></div></div>'; else echo '</div></div></div>'; 
    			}
			}
			$conn->close();		
			}
	}
	?>
    </article>
  </section>
</div>
<footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016<?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>. Sprendimas: <a href="https://codepen.io/martin-hawk/" target="_blank">Martynas Vanagas</a></footer>
</div>
</body>
</html>