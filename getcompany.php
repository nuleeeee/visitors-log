<?php

include "php/session.php";

$sql = "SELECT nameidxx, vname FROM vlookup_mcore.vname where nameidxx in (select nameidz from vlookup_mcore.vsupp) ORDER BY vname ASC";
echo optionlst($db,$sql,"vname","nameidxx");

function optionlst($db,$sqlcommand,$flddsplay,$fldvalue)
{
    $display = "";

    $resultx = mysqli_query($db, $sqlcommand);
    if(mysqli_error($db)!="")
    {
        return mysqli_error($db);
    }
    $count = mysqli_num_rows($resultx);
    if($count == 0)
    {
        $display .= "<option value=0>NO DATA</option>";
    }
    else
    {
        $display .= "<option value=0 selected>Please Select</option>";
        while($rowx = $resultx->fetch_array())
        {
            $display .= "<option value=".$rowx[$fldvalue].">".$rowx[$flddsplay]."</option>";
        }
    }
    return $display;
}

?>