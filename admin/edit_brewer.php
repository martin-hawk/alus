<?php
include 'includes/functions.php';
page_protect('1 2');

if (isset($_POST['update']) == 'Atnaujinti') {
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	mysqli_set_charset($conn,"utf8");
	
	$name = $conn->real_escape_string($_POST['name']);
	if (!isset($_POST['show_name'])) $show_name = '';
	else $show_name = $_POST['show_name'];
	$description = $conn->real_escape_string($_POST['description']);
	if (!isset($_POST['show_description'])) $show_description = '';
	else $show_description =$_POST['show_description'];
	
	if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
	
	$sql = "UPDATE brewers SET name = '$name', show_name = '$show_name', description = '$description', show_description = '$show_description' WHERE id = " . $_GET['id'];
	$conn->query($sql);
	$errors['success'] = 'Duomenys išsaugoti sėkmingai!';
	$conn->close();
	} else {
	$image = 'images/' . $_FILES["image"]["name"];
	
	$target_dir = "../images/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["image"]["tmp_name"]);
    		if($check !== false) {
        		//$errors['isImage'] = "Failas yra " . $check["mime"] . " paveiksliukas.";
        			$uploadOk = 1;
    			} else {
        			$errors['isImage'] = "Failas nėra paveiksliukas.";
        			$uploadOk = 0;
    	}
		$width = $check[0];
		$height = $check[1];
		if ($width == 400 && $height == 400) {
			$uploadOk = 1;
		} else {
			$errors['dimensions'] = "Paveiksliukas turi būti 400x400 px dydžio!";
			$uploadOk = 0;
		}
		// Check if file already exists
		/*if (file_exists($target_file)) {
    		$errors['alreadyExists'] = "Paveiksliukas tokiu pavadinimu jau egzistuoja.";
   			$uploadOk = 0;
		}*/
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    		$errors['format'] = "Deja, bet yra leidžiami tik JPG, JPEG, PNG ir GIF failų formatai.";
    		$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
    		$errors['isOk'] = "Atsiprašome, bet atsirado klaidų.";
		// if everything is ok, try to upload file
		} else {
    		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        		//$errors['successful'] = "Failas ". basename( $_FILES["image"]["name"]). " buvo įkeltas.";
    		} else {
        		$errors['uploadError'] = "Atsiprašome, įvyko klaida įkeliant failą.";
    		}
		}
	
		if ($uploadOk != 0) { 
			$sql = "UPDATE brewers SET image = '$image', name = '$name', show_name = '$show_name', description = '$description', show_description = '$show_description' WHERE id = " . $_GET['id'];
		
			$conn->query($sql);
			$errors['success'] = 'Duomenys išsaugoti sėkmingai!';
			$conn->close();
			}
			}
}
if (isset($_POST['delete']) == 'Ištrinti') {
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	mysqli_set_charset($conn,"utf8");
	
	$sql = "DELETE FROM brewers WHERE id = '" . $_GET['id'] . "'";
	$conn->query($sql);
	
	$helper_sql = "DELETE FROM beers WHERE brewer_id = '" . $_GET['id'] . "'";
	$conn->query($helper_sql);
	
	$errors['success'] = 'Aludario ir jam priskirtų produktų duomenys buvo sėkmingai ištrinti!';
	
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
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
  <h3 style="border-bottom:solid thin #FF9800;">Taisyti aludarį</h3>
  <div class="errorMessage">
    <?php if (isset($errors)) {
		if (isset($errors['isImage'])) echo $errors['isImage'] . '<br>';
		if (isset($errors['dimensions'])) echo $errors['dimensions'] . '<br>';
		if (isset($errors['alreadyExists'])) echo $errors['alreadyExists'] . '<br>';
		if (isset($errors['format'])) echo $errors['format'] . '<br>';
		if (isset($errors['isOk'])) echo $errors['isOk'] . '<br>';
		if (isset($errors['uploadError'])) echo $errors['uploadError'];
		if (isset($errors['success'])) echo $errors['success'];
	} ?>
  </div>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  	<?php
	$configs = include '../config.php';
	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT * FROM brewers WHERE id = " . $_GET['id'];
	$result = $conn->query($sql);

	$row = $result->fetch_assoc();

	$conn->close();
	?>
    <table class="w3-table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="text-align:left;"><label for="image">Paveikslėlis:</label></td>
        <td style="text-align:left;"><input type="file" name="image" id="image" size="32"><br><img src="<?php echo '../' . $row['image']; ?>" class="thumb"><br><?php echo str_replace('images/', '', $row['image']); ?></td>
        <td rowspan="2" align="center" valign="middle"><input type="submit" class="w3-btn w3-light-grey" name="update" value="Atnaujinti"><p></p><input type="submit" class="w3-btn w3-light-grey w3-hover-red" name="delete" value="Ištrinti" data-toggle="tooltip" title="Bus ištrinti ir priskirti produktai!"></td>
      </tr>
      <tr>
        <td style="text-align:left;"><label for="name">Pavadinimas:</label></td>
        <td style="text-align:left;"><input type="text" name="name" value="<?php echo $row['name']; ?>" size="32"></td>
      </tr>
      <tr>
        <td style="text-align:left;"><label for="description">Aprašymas:</label></td>
        <td style="text-align:left;"><textarea name="description"><?php echo $row['description']; ?></textarea></td>
        <td style="text-align:left;"><input type="checkbox" value="1" name="show_name" <?php if ($row['show_name'] == true) echo 'checked'; ?>>
          <label for="show_name">Rodyti pavadinimą</label>
          <br>
          <input type="checkbox" value="1" name="show_description" <?php if ($row['show_description'] == true) echo 'checked'; ?>>
          <label for="show_description">Rodyti aprašymą</label>
      </tr>
        </tr>
      
    </table>
  </form>
</section>
<footer class="w3-container w3-center w3-bottom footer-style">Mažoji bendrija &bdquo;AVILUS&ldquo; &copy; 2016
  <?php if (date('Y') != "2016") echo ' - ' . date('Y'); ?>
  . Sprendimas: <a href="http://martinhawk.co.uk">Martin Hawk</a></footer>
</body>
</html>