<?php
/*Shona Start w17019752
FUNCTIONS

function: establishes connection to the database.*/
function getConnection() {
    try {
        $connection = new PDO("mysql:host=localhost;dbname=unn_w17019752",
            "unn_w17019752", "callme10starts");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }
}

/*function: Declares the document type, language and creates head for each page.
Also starts the body*/
function makePageStart () {
    $pageStartContent = <<<PAGESTART
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
    <title>Northumbria Music Company</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<h1>Northumbria Music Company</h1>
PAGESTART;
    $pageStartContent .="\n";
    return $pageStartContent;
}

/*function: Navigation Menu for logged-in user*/
function makeNavMenuAdmin() {
    $navMenuContentAdmin = <<<ADMIN
	<nav>
		<ul>
			<li style="float: left;"><a href="index.php">Home</a></li>
			<li style="float: left;"><a href="records.php">Records</a></li>	
			<li style="float: left;"><a href="orderRecordsForm.php">Order Records Form</a></li>
			<li style="float: left;"><a href="credits.php">Credits</a></li>
            <li style="float: left;"><a href="logoutProcess.php">Logout</a></li>
        </ul>
	</nav>

ADMIN;
    $navMenuContentAdmin .= "\n";
    return $navMenuContentAdmin;
}

/*function: Navigation Menu for logged-out user and login form*/
function makeNavMenuUser() {
    $navMenuContentUser = <<<USER
	 <form method="post" action="loginProcess.php">
        <p>Username <input type="text" placeholder="Enter Username" name="username" required/>
        Password <input type="password" placeholder="Enter Password" name="password" required/>
        <input type="submit" value="Log in" /></p>
     </form>
    <nav>
		<ul>
			<li style='float: left;'><a href="index.php">Home</a></li>
			<li style="float: left;"><a href="orderRecordsForm.php">Order Records Form</a></li>
			<li style="float: left;"><a href="credits.php">Credits</a></li>
		</ul>
	</nav>

USER;
    $navMenuContentUser .= "\n";
    return $navMenuContentUser;
}

/*function: Creates footer*/
function makeFooter() {
    $footContent = <<< FOOT
    <footer>
        <p>Northumbria Music Company - Shona Start w17019752</p>
    </footer>
FOOT;
    $footContent .="\n";
    return $footContent;
}

/*function: saves any errors in a file on the server
and prints simple error message to user*/
function log_error($e) {
    $logErrors = fopen("error_log_file.log", "ab");
    $message = $e->getMessage();
    $messageDate = date('D M j G:i:s: T Y');
    fwrite($logErrors, $messageDate.$message.PHP_EOL);
    fclose ($logErrors);
    return $e;
}

/*function: Ends the body tag and html tag*/
function makePageEnd() {
    return "</body>\n</html>";
}

/*allows session variables to be accessed -(keeps users logged in)*/
function sessionData(){
    ini_set("session.save_path", "/home/unn_w17019752/sessionData");
    session_start();
}

?>
