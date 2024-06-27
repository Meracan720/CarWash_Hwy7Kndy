<?php
/**
 * Durham College - Fall 2023
 *     INFT 2100 - Lab 3
 * 
 * File name: clients.php
 * Purpose: 
 * 
 ** Requirements:
 *  - Should be a Self-referring form
 *      This page is used for inputting to the client’s table.
 *  - <form> tag is on clients.php code.
 *  - Contents of <form> tag should be made via the display_form function.
 *  - Clients can be created by ADMIN OR Salespeople, so this page is accessible by either
 *  - The link to clients.php (Clients) will appear in the nav bar for either of these user types
 *  - If the current logged in user is a SalesPerson type, then:
 *  - The new client entry will be associated with the current user’s ID (NOT email)
 *  - If the current logged in user is an ADMIN type then:
 *  - A dropdown, or select, should be used. 
 *  - This dropdown will have a list of all users to select from
 *  - The display should be their name, but the value attribute should be their ID.
 *  - This can be retrieved via a db.php function, then looped through to create a select tag similar to (but not the same as) this:
 
 *  - source: w3schools.com
 *  - Upon POST regardless of logged in user type, the data will be validated
 *  - If valid, a client is created, and a messaged is displayed
 *  - If invalid, error messages are supplied, and valid values are “sticky” (they stay after postback)
 *  - Page is accessible to salespeople and ADMINs
 *  - Page is restricted to logged in, otherwise redirect to sign in with appropriate message


 * Author: Gary(Jiaxing) Chen
 * Last update: Nov 29

 *
 *  Update log:
 *      Nov 29:
 *      - Add a new table division to view existing reecords
 *      Oct 29:
 *      - File Created!
*/

// README
$author = "Gary Chen";
$last_update = "Nov 15, 2023";
$title = "INFT - Clients";
$headings = "INFT 2100 - Clients";
$desc = "This page adds new call record.";

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
        // If nothing wrong with the input form, then Add the new client to the database.
        Add_New_Client($email,$first_name,$last_name,$tel);
    }
    


};

?>


<!-- Page Prompt -->
<p>This page should be available to ADMIN and Users <br>
    Just showing stuff about Clients.<br>
    If the login role is sales, it will show the customers.<br>
    If the login is admin, it will have a dropdown list to view sales and their customers.
</p>
    
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
<div>
    <form class="form-signin" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Add a new Client:</h1>
        <p> <?php GetMessage() ?> </p>
        <?php echo DrawForm(ADD_NEW_CLIENT_FORM); ?> 
        <br>
        <!-- Sales list: only visible for ADMIN -->
        <?php 
            if ($user['user_type'] == 'a') {
                echo '
                <label for="sales">Choose a SALES to assign: </label>
                '. Draw_Select('sales');
            }?>

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
    </form>

</div> 
<div>


<!-- Draw tables -->
<h2>Registered Clients</h2>
<p>** Notes: <br>
The pagination UI does not work but the script is capable to show parts of the table.</p>
<?php 
    $current_page = 1;
    $records_per_page = 7;

    // Draw salesman
    $sales_headings = ['ID',"First Name","Last Name","Client e-mail address","Assigned to sales"];
    $records = Query_to_Database("SELECT id, first_name,last_name,email FROM clients");
    echo Display_Table($sales_headings,$records,10);
?>

</div>




<!-- The footer quick script -->
<?php // generalized footer declaring. 
require_once "footer.php";?> 
