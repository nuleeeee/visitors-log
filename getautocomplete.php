<?php
include "php/session.php";

$names = array();

$sql = mysqli_query($db, "SELECT visitorname FROM vlookup_mcore.visitorlogs GROUP BY visitorname");

while ($row = $sql->fetch_array()) {
  $names[] = $row["visitorname"];
}

echo json_encode($names);
