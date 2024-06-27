<?php
/**
 * Durham College - Fall 2023
 *     INFT 2100 - Lab 3
 * 
 * File name: calls.php
 * 
 * Requirements: 
 *      - Should also be a Self-referring form.
 *      - This page is used for inputting data to the calls table.
 *      - <form> tag is on calls.php code.
 *      - Contents of <form> tag should be made via the display_form() function.
 *      - Fields on form should match the database table requirements.
 *      - Page accessible to all user types, but must be logged in.
 *      - Client should be selected from a SELECT/DROPDOWN that is loaded 
 *          using the same functionality from Clients.php when you’re an ADMIN user.
 *      - Form validation should act similar to other pages.
 *      - Success or error message should display on submit.


 * Author: Gary(Jiaxing) Chen
 * Last update: Nov 29

 *
 *  Update log:
 *      Nov 29:
 *      - Add a new table division to view existing reecords
 * 
 *      Oct 29:
 *      - File Created!
*/

// README
$author = "Gary Chen";
$last_update = "Nov 15, 2023";
$title = "INFT - Calls";
$headings = "INFT 2100 - Calls";
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
$datetime_issued = (isset($_POST['datetime_issued'])) ? $_POST['datetime_issued'] : '' ;
$sales_id = (isset($_POST['sales_id'])) ? $_POST['sales_id'] : '' ;
$client_id = (isset($_POST['client_id'])) ? $_POST['client_id'] : '' ;
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '' ;
$call_notes = (isset($_POST['call_notes'])) ? $_POST['call_notes'] : '' ;



// The following happens when user submit the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // This message contains POST only variables.
    $form_debug = " DEBUG INFORMATION: <br>
    sales ID :".$_POST['first_name']." ".$_POST['last_name']." <br>
    client ID :".$_POST['first_name']." ".$_POST['last_name']." <br>
    selected client :".$_POST['last_name']." <br>
    email :".$_POST['email']." <br>
    tel :".$_POST['tel']." <br>
    ";



    // Input Validation
    if ((int)$tel == false) {
        SetMessage('Phone Number does not meet requirements. <br>It need to integers. Yours: ' . gettype($tel));
    } elseif (strlen($tel) != 10) {
        SetMessage('Phone Number does not meet requirements. <br>It need to be 10 characters long. Yours: ' . strlen($tel));
    }
    else {
        // If nothing wrong with the input form, then Add the new client to the database.
        Add_New_CallRecord($sales_id,$client_id,$datetime_issued,$tel,$call_notes);
    }
    


};

?>


<!-- Page Prompt -->
<p>This page should be available to ADMIN and Users , showing stuff about calls.<br>
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
        <h1 class="h3 mb-3 font-weight-normal">Add details for a call:</h1>
        
        <!-- Clients list: All visible -->
        <label for="clients">Choose a client to assign: </label>
        <?php echo Draw_Select('clients'); ?>
        

        <!-- Sales list: only visible for ADMIN -->
        <?php if ($user['user_type'] == 'a') {
                echo '<br><label for="sales">Choose a SALES to assign: </label>
                '. Draw_Select('sales');
            } else{
                echo '<h5>Assigning for: ' .' ['.strtoupper($user['user_type']).'] '. $user['first_name'] .' '. $user['last_name'] . "</h5> <br>";
            }
        ?>
        


        <br>
        <label for="call_details"><h5> Call record details:</h5> </label>
        <!-- Form of calling details -->
        <?php
            // This form contains the following attribute:
            /*
            Datetime 
            */
            echo DrawForm(ADD_NEW_CALL_RECORD);
        ?>

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
        <p> <?php GetMessage() ?> </p>

    </form>
</div>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $form_debug;}?>




<!-- The footer quick script -->
<?php // generalized footer declaring. 
require_once "footer.php";?> 
