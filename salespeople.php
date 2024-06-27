<?php
/**
 * Durham College - Fall 2023
 *     INFT 2100 - Lab 3
 * 
 * File name: salespeople.php
 * Purpose: 
 * 		Show all salespeople. ONLY ADMIN can access this page.

 * Author: Gary(Jiaxing) Chen
 * Last update: Nov 29

 *
 *  Update log:
 *       Nov 29:
 *      - Add a new table division to view existing reecords
 * 
 *      Nov 6:
 *      - Fixed a RIDICULOUS bug regarding user type mismatch. ('a' != 'a ')
 *      Oct 30:
 *      - File Created!
*/

// README
$author = "Gary Chen";
$last_update = "Nov 15, 2023";
$title = "INFT - Sales";
$headings = "INFT 2100 - Sales";
$desc = "This page adds new call salespeople.";


// generalized header declaring. 
require_once "header.php";

// Validate user Type
$user = $_SESSION['user'];
if ($user == null) {
    SetMessage("You are not logged in! Please Go back to the login page!");
    RedirectTo('sign-in.php');
}

// Variables Declaration
$first_name =  '' ;
$last_name = '';
$email = '';
$tel = '';

// Table Handling:
$first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '' ;
$last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '' ;
$email = (isset($_POST['email'])) ? $_POST['email'] : '' ;
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '' ;



// The following happens when user submit the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // This message contains POST only variables.
    $form_debug = "
    Value of first_name :".$_POST['first_name']." <br>
    last_name :".$_POST['last_name']." <br>
    email :".$_POST['email']." <br>
    tel :".$_POST['tel']." <br>
    ";

    // DEBUG Information
    echo $form_debug;


    // Input Validation
    if ((int)$tel == false) {
        SetMessage('Phone Number does not meet requirements. <br>It need to integers. Yours: ' . gettype($tel));
    } elseif (strlen($tel) != 10) {
        SetMessage('Phone Number does not meet requirements. <br>It need to be 10 characters long. Yours: ' . strlen($tel));
    }
    else {
        // If nothing wrong with the input form, then Add the new salesperson to the database.
        Add_New_Sales($email,$first_name,$last_name,$tel);
    }

};

?>
    <p>
    Author's Notes:
    <br> 
    This page should NOT be available except ADMIN <br> ([A] tag beside your login role.) <br>
    <br>This page shows a form for add new sales.
    
    </p>
    
    <?php 
    // User type validation in webpage
    echo '<p> 
        Your Login role is: '. $user['user_type'].'<br>';
    if ($user['user_type'] == 'a'){echo "So You are logged as ADMIN, Welcome!<br> You are allowed to view this page.";} 
    else {echo "Type Invalid! You are not allowed to view this page. ";} 

    echo '</p>';
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
<div>
    <?php 
    // Check If the user is ADMIN
    if ($user['user_type'] == 'a') {
            echo '
                <form class="form-signin" method="POST">
                    <h1 class="h3 mb-3 font-weight-normal">Add a new salesperson:</h1>
                    <p>'. GetMessage(). '</p>
                    '.DrawForm(ADD_NEW_SALES_FORM).'
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
                </form>
            ';
        };
    ?>


<p>Page: <input type='text' id='page_num'class="page-link" placeholder='1'  required autofocus></p>
<button class="btn btn-lg btn-primary btn-block" type="submit" id="goto">Goto</button>
<p>** Notes: <br>
The pagination UI does not work but the script is capable to show parts of the table.</p>
<?php
    $current_page = 1;
    $records_per_page = 7;

    // Draw salesman
    $sales_headings = ['ID',"First Name","Last Name","email address","Now Active?"];
    $records = Query_to_Database("SELECT id, first_name,last_name,email,active_or_not FROM salespeople");
    echo Display_Table($sales_headings,$records,10);
?>




</div>



<!-- The footer quick script -->
<?php // generalized footer declaring. 
require_once "footer.php";?> 