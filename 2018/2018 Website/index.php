<?php
/*  Shona Start w17019752
    Task 5 - Home page*/
try {
    require_once("functions.php");
    $dbConn = getConnection();
    echo makePageStart();
    echo sessionData();
    if(isset($_SESSION['logged-in'])) {
        echo makeNavMenuAdmin();
    }
    else{
        echo makeNavMenuUser();
    }
?>
    <!--Part A + B-->
    <aside id='offers'>
        <script src="offers.js"></script>
    </aside>

    <!--Part C-->
    <aside id='XMLoffers'>
        <script src="XMLoffers.js"></script>
    </aside>

<?php
    echo makeFooter();
    echo makePageEnd();
}
catch (Exception $e){
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
?>


