<?php
/*  Shona Start w17019752
    Task 6 - Credits page*/
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
    echo"
         <p>Name: Shona Rachael Start</p>
         <p>Student ID: w17019752</p>
         <p>Email: shona.start@northumbria.ac.uk</p>
         <h2>References</h2>
         <ul>
            <li>W3Schools(2017). SQL Tutorial. [online]. Available at: https://www.w3schools.com/sql/default.asp [Accessed date: 12/11/2018].</li>
            <li>Elvin, G. (2018). Web programming - PHP re-cap and PDO.</li>
            <li>Elvin, G. (2018). Web programming - Web Hashing and sessions.</li>
            <li>Elvin, G. (2018). Web programming - Handling files and exceptions.</li>
            <li>Northumbria University. (2018). A sample solution for one of the workshop 3 exercises. [image] Available at: https://elp.northumbria.ac.uk/ultra/courses/_597349_1/cl/outline [Accessed date: 19/11/2018].</li>
            <li>W3Schools(2017). JavaScript and HTML DOM Reference.[online]. Available at: https://www.w3schools.com/jsref/default.asp [Accessed date: 28/11/2018].</li>
            <li>Rooksby, J. (2018). AJAX, JSON and XML - KF5002 Web Programming Week 10</li>
            <li>W3C(2006). Markup Validation Service. [online]. Available at: https://validator.w3.org/ [Accessed date: 17/12/2018].</li>
            <li>Lurig, M (2014). PHP Code Checker. [online]. Available at: https://phpcodechecker.com/ [Accessed date: 17/12/2018].</li>
            <li>Waldron, R. Potter, C. Pennisi, M. Page, L.(2013). JSHint. [online]. Available at: https://jshint.com/ [Accessed date: 17/12/2018].</li>
         </ul>";

    echo makeFooter();
    echo makePageEnd();
}
catch (Exception $e){
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
?>