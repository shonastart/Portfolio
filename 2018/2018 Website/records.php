<?php
/*  Shona Start w17019752
    Task 1 - Choose a record to edit
    Task 3 - Server-side data validation and making data safe*/
try {
    require_once("functions.php");
    $dbConn = getConnection();
    echo makePageStart();
    echo sessionData();
    if (isset($_SESSION['logged-in'])) {
        echo makeNavMenuAdmin();
        $sqlQuery = "SELECT recordID, recordTitle, recordYear, nmc_records.catID, recordPrice, nmc_category.catDesc
		FROM nmc_records
		INNER JOIN nmc_category
		ON nmc_category.catID = nmc_records.catID
		ORDER BY recordTitle";
        $queryResult = $dbConn->query($sqlQuery);
        while ($rowObj = $queryResult->fetchObject()) {
            echo "<div class='record'>
            <table>
                <tr> 
                    <th>Record ID</th>
                    <td><span class='id'>{$rowObj->recordID}</span></td>
                    <th>Title</th>
                    <td><span class='title'><a href='editRecords.php?recordID={$rowObj->recordID}'>{$rowObj->recordTitle}</a></span></td>
                    <th>Year</th>
                    <td><span class='year'> {$rowObj->recordYear}</span></td>
                    <th>Category Description</th>
                    <td><span class='cat'>{$rowObj->catDesc}</span></td>
                    <th>Price</th>
                    <td><span class='price'>{$rowObj->recordPrice}</span></td>    
                </tr>
            </table>
        </div>";
        }
    }
    else{
        echo makeNavMenuUser();
        echo "<p>Restricted please login</p>";

    }
}
catch (Exception $e) {
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
    echo makeFooter();
    echo makePageEnd();
?>

