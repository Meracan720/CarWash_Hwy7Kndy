<?php

/**
 * File name: dashboard.php
 * Project Purpose: 
 * 		The main Page after logged in

 * Author: Gary(Jiaxing) Chen
 * Last update: Nov 15

 * Update Log:
 *      Nov 15
 *      - Add some comment variables and alter webpage title
 * 
 *      Sep 28
 *      - Optimize some functions and added comments for all functions
 * 
 *      Sep 26
 *      - File Created!
*/

// README
$author = "Gary Chen";
$last_update = "September 28, 2023";
$title = "INFT - Main Page";
$headings = "INFT 2100 Main Page";
$desc = "The sign-in page for the dashboard.";


// generalized header declaring. 
require_once "header.php";

?>
<!-- Above is The header quick script -->  

<h1 class="h2"><br>Welcome to the Dashboard! <br>..</h1>
<p><?php echo GetMessage(); ?></p>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary">Share</button>
    <button class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
    <span data-feather="calendar"></span>
    This week
    </button>
</div>
</div>


<div>
<!-- Draw tables -->

<h2>Registered salesman: </h2>
<p>** Notes: <br>
The pagination UI does not work but the script is capable to show parts of the table.</p>
<?php 

    // Draw salesman
    $sales_headings = ['ID',"First Name","Last Name","email address","Now Active?"];
    $records = Query_to_Database("SELECT id, first_name,last_name,email,active_or_not FROM salespeople");
    echo Display_Table($sales_headings,$records,10);
?>
</div>




<!-- The footer quick script -->
<?php 
// generalized footer declaring. 
require_once "footer.php";?> 