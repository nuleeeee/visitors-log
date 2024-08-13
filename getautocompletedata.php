<?php
include "php/session.php";

$name = $_POST['name'];

$data = array();

$sql = mysqli_query($db, "SELECT visitorcompany, visitorcontactnum FROM vlookup_mcore.visitorlogs WHERE visitorname = '$name' GROUP BY visitorname ");

while ($row = $sql->fetch_array()) {
  $data[] = array("company" => $row["visitorcompany"], "contact" => $row["visitorcontactnum"]);
}

echo json_encode($data);
?>