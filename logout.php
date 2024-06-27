<?php

/**
 * Durham College - Fall 2023
 *     INFT 2100 - Lab 2
 * 
 * File name: logout.php
 * Purpose: 
 * 		THE Universal logout page for all the projects through the semsester

 * Author: Gary(Jiaxing) Chen
 * Last update: Oct 29

 *
 *  Update log:
 *      Oct 29:
 *      - File Created!
*/

// generalized header declaring. 
require_once "header.php";

    WriteLog($_SESSION['user']['email'] ." successfully sign OUT at " .  date('Y-m-d H:i:s'));
    
?>
<p><?php echo GetMessage(); ?></p>

<!-- The footer quick script -->
<?php 

//sleep(3);
session_unset();
session_destroy();
session_start();
SetMessage("you successfully logged out.");
RedirectTo('sign-in.php');

// generalized footer declaring. 
require_once "footer.php";?> 