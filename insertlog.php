<?php
include "php/session.php";

if (isset($_POST['visitors_name']))
{
	$visitors_name = $_POST['visitors_name'];
	$date_visited = $_POST['date_visited'];
	$visitors_company = $_POST['visitors_company'];
	$visitors_contact = $_POST['visitors_contact'];
	$select_person = $_POST['select_person'];
	$select_purpose = $_POST['select_purpose'];
	$si_num = $_POST['si_num'];

	$sql = mysqli_query($db, "INSERT INTO vlookup_mcore.visitorlogs (visitorname, visitorcompany, visitorcontactnum, persontovisit, purpose, drsinum, datevisited, tsz) VALUES ('$visitors_name', '$visitors_company', '$visitors_contact', '$select_person', '$select_purpose', '" . ($si_num ?: 'NULL') . "', '$date_visited', NOW())");
}

if (!$sql) {
    echo "Error: " . mysqli_error($db);
} else {
    echo "Data saved!";
}