<?php

include "php/session.php";

$display = "<table class='table table-hover table-bordered text-wrap w-100' id='logs' style='font-size: 14px;'>
                <thead class='thd'>
                    <tr>
                        <th class='text-center'>VISITOR PASS</th>
                        <th class='text-center'>NAME</th>
                        <th class='text-center' style='max-width: 200px;'>COMPANY</th>
                        <th class='text-center'>CONTACT NUMBER</th>
                        <th class='text-center'>PERSON TO VISIT</th>
                        <th class='text-center'>PURPOSE</th>
                        <th class='text-center'>DATE</th>
                        <th class='text-center'>IN</th>
                        <th class='text-center'>OUT</th>
                    </tr>
                </thead>
                <tbody>";

    $sql = "SELECT  visitoridxx, visitorname, CASE WHEN visitorcompany REGEXP '^[0-9]+$' THEN vname ELSE visitorcompany END AS company,
                    visitorcontactnum, datevisited, TIME_FORMAT(timein, '%h:%i:%s %p') AS timein,
                    TIME_FORMAT(timeout, '%h:%i:%s %p') AS timeout, persontovisit, purpose, visitorpass, lg.tsz
            FROM vlookup_mcore.visitorlogs lg
            LEFT OUTER JOIN vlookup_mcore.vname vn ON vn.nameidxx = lg.visitorcompany
            WHERE DATE(lg.tsz) = CURDATE()
            ORDER BY tsz DESC";

    $result = mysqli_query($db,$sql);
    while($row = $result->fetch_array())
    {

        $display .= "<tr>
                        <td class='table-light border-top text-center fw-bold text-primary pointer' title='View Pass' onclick=\"viewVisitorPass('".$row["visitorpass"]."')\">" . $row["visitorpass"] . "</td>
                        <td class='table-light border-top text-wrap'>" . $row["visitorname"] . "</td>
                        <td class='table-light border-top text-wrap'>" . $row["company"] . "</td>
                        <td class='table-light border-top text-center'>" . $row["visitorcontactnum"] . "</td>
                        <td class='table-light border-top text-center'>" . $row["persontovisit"] . "</td>
                        <td class='table-light border-top text-center'>" . $row["purpose"] . "</td>
                        <td class='table-light border-top text-center'>" . $row["datevisited"] . "</td>
                        <td class='table-light border-top text-center'>" . $row["timein"] . "</td>
                        <td class='table-light border-top text-center'>" . $row["timeout"] . "</td>
                    </tr>";

    }



$display .= "   </tbody>
            </table>

<script>
    $(document).ready(function(){
        $('#logs').DataTable({
            'paging': false,
            sorting: false,
            searching: false
        });
    });
</script>";



echo $display;

?>