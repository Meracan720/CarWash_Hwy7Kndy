<?php

/**
 * File name: dashboard.php
 * Project Purpose: 
 * 		The main Page after logged in

 * Author: Gary(Jiaxing) Chen
 * Last update: June 27, 2024

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
$last_update = "June 27, 2024";
$title = "Carwash - Main Dashboard";
$headings = "Carwash Main Page";
$desc = "The sign-in page for the dashboard.";


// generalized header declaring. 
require_once "header.php";

?>
<!-- Above is The header quick script -->  

<h1 class="h2"><br>Main Dashboard </h1>
<p><?php echo GetMessage(); ?></p>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary">Share</button>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar">    This week</span>
    </button>
</div>
</div>


<div>
<!-- Draw Summarys -->

<!-- Show how many bookings-->
<div>
<h3>Ongoing Bookings:</h3> <?php echo 'num of appointment today';?>


</div>
<div>

</div>







<!-- The footer quick script -->
<?php 
// generalized footer declaring. 
require_once "footer.php";?> 