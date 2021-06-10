<?php
/*  Shona Start w17019752
    Task 1 - Edit details of a record
    Task 3 – amended records in the MySQL database*/

try {
    require_once("functions.php");
    $dbConn = getConnection();
    echo makePageStart();
    echo sessionData();
    if(isset($_SESSION['logged-in'])) {
        echo makeNavMenuAdmin();

        $recordID = filter_has_var(INPUT_GET, 'recordID')
            ? $_GET['recordID'] : null;
        $recordTitle = filter_has_var(INPUT_GET, 'recordTitle')
            ? $_GET['recordTitle'] : null;
        $recordYear = filter_has_var(INPUT_GET, 'recordYear')
            ? $_GET['recordYear'] : null;
        $catID = filter_has_var(INPUT_GET, 'catDesc')
            ? $_GET['catDesc'] : null;
        $pubName = filter_has_var(INPUT_GET, 'pubName')
            ? $_GET['pubName'] : null;
        $recordPrice = filter_has_var(INPUT_GET, 'recordPrice')
            ? $_GET['recordPrice'] : null;

        $sqlcatDesc = "SELECT catDesc
                     FROM nmc_category
                     WHERE catID = '$catID'";
        $sqlpubID = "SELECT pubID
                     FROM nmc_publisher
                     WHERE pubName = '$pubName'";

        $querycatDesc = $dbConn->query($sqlcatDesc);
        $querypubID = $dbConn->query($sqlpubID);


        /*START - title validation*/
        $recordTitle = trim($recordTitle);
        //   $recordTitle = htmlspecialchars($recordTitle);
        $recordTitle = filter_var($recordTitle,FILTER_SANITIZE_SPECIAL_CHARS);
        //   $recordTitle = filter_var($recordTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        if (empty($recordTitle) or strlen($recordTitle) > 100) {
            echo "<p>You need to enter a valid title, Please go back and amend this before continuing</p>";
        }
        /*END - title validation*/
        /*START - year validation*/
        $recordYear = trim($recordYear);
        //    $recordYear = htmlspecialchars($recordYear);
        $recordYear = filter_var($recordYear,FILTER_SANITIZE_SPECIAL_CHARS);
        //    $recordYear = filter_var($recordYear, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        if (empty($recordYear) or strlen($recordYear) != 4) {
            echo "<p>You need to enter a valid year, Please go back and amend this before continuing</p>";
        }
             if (!filter_var($recordYear, FILTER_VALIDATE_INT )){
                 echo "<p>You need to enter whole numbers for the year, Please go back and amend this before continuing</p>";
             }
        /*END - year validation*/
        /*START - price validation*/
        $recordPrice = trim($recordPrice);
        //    $recordPrice = htmlspecialchars($recordPrice);
        $recordPrice = filter_var($recordPrice,FILTER_SANITIZE_SPECIAL_CHARS);
        //    $recordPrice = filter_var($recordPrice, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
        if (empty($recordPrice) or strlen($recordPrice) < 4) {
            echo "<p>You need to enter a valid price, Please go back and amend this before continuing</p>";
        }
           if (!filter_var($recordPrice, FILTER_VALIDATE_FLOAT )){
                echo "<p>You need to enter numbers for the price, Please go back and amend this before continuing</p>";
            }
        /*END - price validation*/

        else {
            while ($rowObj1 = $querycatDesc->fetchObject()) {
                $catDesc = $rowObj1->catDesc;
                echo "
                <p>Record ID: $recordID</p>
                <p>Title: $recordTitle</p>
                <p>Year: $recordYear</p>
                <p>Category: $catDesc</p>
                <p>Publisher: $pubName</p>
                <p>Price: £$recordPrice</p>";
            }
        }

        /*amended records in the MySQL database*/
        while ($rowObj2 = $querypubID->fetchObject()) {
            $pubID = $rowObj2->pubID;
            $updateSQL = "UPDATE nmc_records
                                 SET recordTitle= '$recordTitle', recordYear = '$recordYear', pubID = '$pubID', catID = '$catID', recordPrice = '$recordPrice'
                                 WHERE recordID=$recordID";
            $dbConn->exec($updateSQL);
        }
    }
    else{
        echo makeNavMenuUser();
        echo "<p>Restricted please login</p>";
    }
    echo makeFooter();
    echo makePageEnd();
}
catch (Exception $e){
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
?>