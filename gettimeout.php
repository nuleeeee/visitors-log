<?php
include "php/session.php";

if (isset($_POST['visitorid']))
{
	$visitorid = $_POST['visitorid'];

	$sql = mysqli_query($db, "UPDATE vlookup_mcore.visitorlogs SET timeout = NOW() WHERE visitorpass = '$visitorid' AND datevisited = CURDATE()");

}

if (!$sql) {
    echo "Error: " . mysqli_error($db);
} else {
    echo "Logged out successfully!";
}

?>