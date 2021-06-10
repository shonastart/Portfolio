<?php
/*  Shona Start w17019752
    Task 1 - Edit details of a record
    Task 3 – Server-side data validation and making data safe*/

$recordID = filter_has_var(INPUT_GET, 'recordID') ? $_GET['recordID'] : null;
try {
    require_once("functions.php");
    $dbConn = getConnection();
    echo makePageStart();
    echo sessionData();
    if(isset($_SESSION['logged-in'])) {
        echo makeNavMenuAdmin();

        $sqlQuery = "SELECT recordID, recordTitle, recordYear, nmc_records.catID, recordPrice, nmc_category.catDesc, nmc_publisher.pubID, nmc_publisher.pubName
		  FROM nmc_records
          INNER JOIN nmc_category
          ON nmc_category.catID = nmc_records.catID
          INNER JOIN nmc_publisher
		  ON nmc_publisher.pubID = nmc_records.pubID
		  WHERE recordID = $recordID";

        $sqlCat = "SELECT DISTINCT * 
               FROM nmc_category
               GROUP BY catDesc";

        $sqlPub = "SELECT DISTINCT *
               FROM nmc_publisher
               GROUP BY pubName";

        $queryResult = $dbConn->query($sqlQuery);
        $queryDesc = $dbConn->query($sqlCat);
        $queryPub = $dbConn->query($sqlPub);
        $rowObj = $queryResult->fetchObject();


        /*START - Form for editing Records*/
        echo "
        <form id='editRecords' action='updateRecords.php?recordID={$rowObj->recordID}' method='get'>
            <p>Record ID <input type='text' name='recordID' value='{$rowObj->recordID}' readonly /></p>
            <p>Title <input type='text' name='recordTitle' size='50' minlength='3' maxlength='80' value='{$rowObj->recordTitle}' required /></p>                  
	    	<p>Year <input type='number' name='recordYear' min='1000' max='3000' step='1' value='{$rowObj->recordYear}' required /></p> 
	    	<p>Category:
	    	<select name='catDesc'>
                <option value='$rowObj->catID'>$rowObj->catDesc</option>\n";
                while ($rowObj2 = $queryDesc->fetchObject()) {
                    if ($rowObj2->catID != $rowObj->catID) {
                        echo "    <option value='{$rowObj2->catID}'>{$rowObj2->catDesc}</option>\n";
                }
            }
            echo "    </select></p>\n";

        echo "<p>Publisher:
                <select name='pubName'>
                    <option value='$rowObj->pubName'>$rowObj->pubName</option>\n";
                while ($rowObj3 = $queryPub->fetchObject()) {
                    if ($rowObj3->pubName != $rowObj->pubName){
                        echo "    <option value='{$rowObj3->pubName}'>{$rowObj3->pubName}</option>\n";
                    }
                }
        echo "    </select></p>";

        echo "
			<p>Price <input type='number' name='recordPrice' min='1' max='99'  step='0.01' value='{$rowObj->recordPrice}' required /></p>
            <input type='submit' value='Submit'>
            <input type='reset'>
        </form>
        \n";
    }
    /*END - Form for editing Records*/
    else{
            echo makeNavMenuUser();
            echo "<p>Restricted please login</p>";
    }
}
catch (Exception $e){
    log_error($e);
    echo "A problem occurred. Please try again\n";
}

echo makeFooter();
echo makePageEnd();
?>
