<?php
/*  Shona Start w17019752
    Task 4 - pre‐task*/
try {
    require_once("functions.php");
    $dbConn = getConnection();
    echo makePageStart();
    echo sessionData();
    if (isset($_SESSION['logged-in'])) {
        echo makeNavMenuAdmin();
    }
    else{
        echo makeNavMenuUser();
    }
}

catch (Exception $e) {
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
?>

<?php
/* This code dynamically generates a web page containing a form designed with the html required to display one
checkbox for each of the records currently held in the nmc_records database table has been provided for you in the
assessment section for the module on blackboard. The user can select one or more records that they are interested in
ordering by clicking the checkboxes.
Use the browser to look at the structure of the html generated by the php code. */

$url = "http://unn-izge1.newnumyspace.co.uk/KF5002/assessment/orderRecordsFormInc.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
?>

<!-- Here you need to add Javascript or a link to a script (.js file) to process the form as required for the assignment -->
<script src="orderRecordsJava.js"></script>

<?php
    echo makeFooter();
    echo makePageEnd();
?>