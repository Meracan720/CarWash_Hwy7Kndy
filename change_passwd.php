<?php
/**
 * Durham College - Fall 2023
 *     INFT 2100 - Lab 3
 * 
 * File name: change_passwd.php
 * Purpose: 
 *      help logged users to change/update password.


 * Author: Gary(Jiaxing) Chen
 * Last update: Nov 29

 *
 *  Update log:
 *      Nov 29:
 *      - File Created!
*/

// README
$author = "Gary Chen";
$last_update = "Nov 29, 2023";
$title = "User - Change Password";
$headings = "INFT 2100 - Chpswd";
$page_desc = "This page allows logged users to change password.";

// generalized header declaring. 
require_once "header.php";

// Validate user Type
$user = $_SESSION['user'];
if ($user == null) {
    SetMessage("You are not logged in! Please Go back to the login page!");
    RedirectTo('sign-in.php');
}


// Variables Declaration
$current_password = (isset($_POST['current_passwd'])) ? $_POST['current_passwd'] : '' ;
$new_password = (isset($_POST['new_password'])) ? $_POST['new_password'] : '' ;
$cnfm_password = (isset($_POST['cnfm_password'])) ? $_POST['cnfm_password'] : '' ;



// The following happens when user submit the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $align = ($_POST['new_password'] == $_POST['cnfm_password']) ? 'Yes': 'No';
    // This message contains POST only variables.
    $form_debug = "
    Value of new_password :".$_POST['new_password']." <br>
    Value of cnfm_password :".$_POST['cnfm_password']." <br>
    Are They Aligned? :". $align ." <br>
    ";


    // DEBUG Information
    echo $form_debug;

    // Input Validation
    if (isset($new_password) && isset($cnfm_password)) {
        if (isset($new_password) == isset($cnfm_password)) {
            SetMessage("Password are identical. Good to pass.");

            $receipt = Change_Password($_SESSION['user'],$current_password,$new_password);
            // Update new password to the database.


        } else {
            SetMessage("Password do not match!!");
        }
    };
};

?>


<!-- Page Prompt -->
<p><?php echo $page_desc;?></p>
    
    <?php 
    // User type validation in webpage
    /*
    
    echo '<p> 
        Your Login role is: '. $user['user_type'].'<br>';
    if ($user['user_type'] == 'a'){echo "So You are logged as ADMIN, Welcome!";} 
    else {echo "Type Invalid! You are not allowed to view this page. ";} 

    echo '</p>';

    */
    ?>
    <p>
        <!-- The sign-out button -->
        <button class="btn btn-sm btn-outline-secondary" href="/sign-in.php">
            <a class="nav-link" style="color:black" href="./logout.php">Back to Login</a>
        </button>
    </p>

</div>

<!-- The Form to add a new salespeople.
    This form table should be visible ONLY for ADMIN -->
<div class="row">
    <form class="form-signin" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Change password</h1>
        <?php echo DrawForm(FORM_CHPSWD); ?> 

        <p> <?php GetMessage() ?> </p>

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit Changes</button>
    </form>

</div> 
<div>
<p>Idk. Probably a table here? ... </p>
</div>




<!-- The footer quick script -->
<?php // generalized footer declaring. 
require_once "footer.php";?> 
