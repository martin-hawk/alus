<?php
function page_protect($level) {
	
	$configs = include '../config.php';

	$conn = new mysqli($configs['host'], $configs['username'], $configs['password'], $configs['dbname']);

	if ($conn->connect_error) {	die("Connection failed: " . $conn->connect_error); } 
	mysqli_set_charset($conn,"utf8");

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!$_SESSION['logged_in']) {
        $access = false;
    } else {
        $kt = preg_split('/\W/', $level, -1, PREG_SPLIT_NO_EMPTY);

        $sql = "SELECT access_level FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
        
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

        $access = false;

        while (list($key, $val) = each($kt)) {
            if ($val == $row['access_level']) {
                $access = true;
            }
        }
    }
    if ($access == false) {
        header("Location: ../admin/denied.php");
    }
}
?>