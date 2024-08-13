<?php
include "php/session.php";

if (isset($_POST['visitorid']))
{
	$visitorid = $_POST['visitorid'];

    $query = mysqli_query($db, "SELECT IF(IFNULL(SUM(timein),0)-IFNULL(SUM(timeout),0) = 0,1,2) as cntlog,SUM(timein)-SUM(timeout) FROM
    (
        SELECT IF(timein = 0 OR ISNULL(timein),0,1) as timein,IF(timeout = 0 OR ISNULL(timeout),0,1) as timeout FROM vlookup_mcore.visitorlogs WHERE datevisited = CURDATE() AND visitorpass = '$visitorid'
    ) as tbllogs");

    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if($row["cntlog"] == 1)
    {
        $sql = mysqli_query($db, "UPDATE vlookup_mcore.visitorlogs SET timein = NOW(), visitorpass = '$visitorid' WHERE datevisited = CURDATE() AND timein IS NULL AND timeout IS NULL AND visitorpass IS NULL ORDER BY tsz ASC LIMIT 1");

        echo "Time In Saved!";
    }
    else
    {
        $sql = mysqli_query($db, "UPDATE vlookup_mcore.visitorlogs SET timeout = NOW() WHERE datevisited = CURDATE() AND timeout IS NULL AND visitorpass = '$visitorid' ORDER BY tsz ASC LIMIT 1");

        echo "Time Out Saved!";
    }

    // Close the database connection when done
    mysqli_close($db);

}

?>