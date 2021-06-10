<?php
/*  Shona Start w17019752
    Task 2 - Logout script*/
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

    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged-in']);
    session_destroy();
    header("location: index.php"); /*redirects user to index page*/

    echo makeFooter();
    echo makePageEnd();
}
catch (Exception $e){
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
?>