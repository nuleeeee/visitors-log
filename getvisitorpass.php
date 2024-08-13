<?php
include "php/session.php";

// Initialize an array to store selected numbers
$selectedNumbers = array();

// Query to retrieve selected visitorpass values
$sql = mysqli_query($db, "SELECT visitorpass FROM vlookup_mcore.visitorlogs WHERE timeout IS NULL AND datevisited = CURDATE()");

while($row = $sql->fetch_array()) {
    $pass = $row["visitorpass"];
    
    // Check if the value is a number between 1 and 20
    if (is_numeric($pass) && $pass >= 1 && $pass <= 20) {
        // Add the selected number to the array
        $selectedNumbers[] = (int)$pass;
    }
}

// Generate a list of unselected numbers
$unselectedNumbers = array();
for ($i = 1; $i <= 20; $i++) {
    if (!in_array($i, $selectedNumbers)) {
        $unselectedNumbers[] = $i;
    }
}

// Create options for the unselected numbers
$options = "";
foreach ($unselectedNumbers as $number) {
    $options .= "<option value=\"$number\">$number</option>";
}

// Echo the options
echo $options;
?>
