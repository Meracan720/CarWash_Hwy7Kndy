<?php

/**
 * File name: sign-in.php
 * Project Purpose: 
 *      A script file for all database-related functions

 * Author: Gary(Jiaxing) Chen
 * Last update: HALLOWEEN
 * 
 * Update Log:
 *      HALLOWEEN (Oct 31):
 *      - Code optimizaitons & enable password ENCRYPTION Comparison.
 * 
 *      Sep 28
 *      - Optimize some functions and added comments for all functions
 *   
 *      Sep 26
 *      - File Created!
*/

// README
$author = "Gary Chen";
$last_update = "Nov 14, 2023";
$title = "Sign-in LATEST";
$headings = "INFT 2100 Sign-in";
$desc = "The sign-in page for the dashboard.";


// If someone successfully signed in:
//$_SESSION['message']="you've successfully logged in.";

// generalized header declaring. 
require_once "header.php";

    // Pre-assigned strings:
    $_SESSION['username'] = '';
    $_SESSION['password' ]= '';
    $_SESSION['message'] = '';

    // Check if the credentials are fillee
    if (isset($_POST['username']) && isset($_POST['password'])) {

        // Input validation
        $username = $_POST['username'];
        if ($username === '') {
            $_SESSION['message'] .= "<br>Require Username";
        }

        $password = $_POST['password'];
        if ($password === '') {
            $_SESSION['message'] .= "<br>Password required";
        }
        
        if ($_SESSION['message'] === ''){

            // Sanitize before submitting
            $username = pg_escape_string($_POST['username']);
            $password = pg_escape_string($_POST['password']);

            $user = user_authenticate($username, $password);
            // Logon status check
            
            if($user != false)
            {
                SetMessage("Hello, " . $user['first_name'] . ", Last successful login was " . $user['last_login_time']);
                $_SESSION['user'] = $user;
                WriteLog($user['email'] ." signed in successfully at ". "UTC " .date('Y-m-d H:i:s'));
                // Re-direct to the main page
                RedirectTo('dashboard.php');
                //user is logged in successfully
            } else {
                if ($user == null){
                    $user['email'] = 'Unregistered guest';
                }
                WriteLog($user['email'] ." sign FAILED at " . "UTC".date('Y-m-d H:i:s'));
                //user did not login successfully
                SetMessage("Logon unsuccessful. Credentials does not match.");
                $_SESSION['username'] = '';
                $_SESSION['password']= '';
            }
        }
    }


    
?>

<!--  obsolete code for db state confirming -->




<!-- #region Login UI  -->
<form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <p><?php echo GetMessage();?></p>
    <?php echo DrawForm(LOGIN_FORM)?>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>


</form>

<!-- #endregion -->




<!-- The footer quick script -->
<?php 
// generalized footer declaring. 
require_once "footer.php";?> 

