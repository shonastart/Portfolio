<?php
/*  Shona Start w17019752
    Task 2 - Logon script*/
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
    
    $username = filter_has_var( INPUT_POST, 'username')
        ? $_POST ['username'] : null;
    $password = filter_has_var( INPUT_POST, 'username')
        ? $_POST ['password'] : null;

    $username = htmlspecialchars($username);

    if (empty($username) OR empty($password)) {
        echo "<p>Unable to login</p>
               <p>Please enter username and password</p>";
    }
    else{
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['logged-in']);
        $querySQL = "SELECT *
                 FROM nmc_users
                 WHERE username = :username";
        $statement = $dbConn->prepare($querySQL);
        $statement->execute(array(':username' => $username));
        $user = $statement->fetchObject();
        if($user) {
            if (password_verify($password, $user->passwordHash)) {
                $_SESSION['logged-in'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $user->passwordHash;
                header("location: index.php"); /*redirects user to index page*/
            }
            else {
                header("location: index.php"); /*redirects user to index page*/
            }
        }
        else{
            header("location: index.php"); /*redirects user to index page*/
        }
    }

    echo makeFooter();
    echo makePageEnd();
}
catch (Exception $e){
    log_error($e);
    echo "A problem occurred. Please try again\n";
}
?>