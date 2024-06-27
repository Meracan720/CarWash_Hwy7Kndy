<?php
/**
 * Durham College - Fall 2023
 *     INFT 2100 - Lab 2
 * 
 * File name: header.php
 * Purpose: 
 * 		THE Universal header page for all the projects through the semsester

 * Author: Gary(Jiaxing) Chen
 * Last update: Nov 23

 *
 *  Update log:
 *      Nov 23: 
 *      - Add a link back to the main Index page when user is not logged in.
 * 
 *      Oct 30:
 *      - Add 'Salespeople' and 'Clients' page to the left nav bar AFTER LOGIN.
 * 
 *      Oct 17:
 *      - Post-submission Optimizations
 * 
 *      Sep 29:
 *      - Change 'user-creation date' from pre-configured to 
 *
 *      Sep 26:
 *      - File Created!
*/

?>
<!doctype html>
    <html lang="en">
    <head>

		<?php
			session_start();
			ob_start();
			require_once "./functions/constants.php";    // import Website Constants
            require_once "./functions/db.php";           // import Database-related functions
			require_once "./functions/functions.php";    // import ..... well, the functions


			if (isset($_SESSION['last_login'])) {
				$last_login = $_SESSION['last_login'];
			} else {
				$last_login = "";
			}

		?>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title><?php echo $title ;?></title>

        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./css/styles.css" rel="stylesheet">
        
    </head>
    <body>
    
        <!-- Top Nav Bar-->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" 
            <?php 
            if(!isset($_SESSION['user'])){
                echo 'href="../index.php">Back to Welcome Page';} else{ echo 'href=""';
                } ?>
                > <!-- End of the <a> tag -->

            </a>

            <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <?php if(isset($_SESSION['user'])){ echo '<a class="nav-link" href="./logout.php">Sign out</a>';} else{ echo '<a class="nav-link" href=""></a>'; } ?>
            </li>
            </ul>
        </nav>


        

        <!-- 
            Left side Nav Bar
            ONLY VISIBLE WHEN LOGGED IN.
        -->
        <?php if(isset($_SESSION['user'])){ echo '

        <div class="container-fluid">
        <div class="row">
        
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            


            <!-- Left: Basic functionalities -->
            <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <!-- Left: Login user information -->
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <span data-feather="home"></span>
                        Login as: <br> 
                        ['.strtoupper($_SESSION["user"]["user_type"]).']'. $_SESSION["user"]["first_name"]. '<br>
                        <span class="sr-only">(current)</span>
                    </a>
                    <a class="nav-link" href="./change_passwd.php">
                        <span data-feather="home"></span>
                        Change Password<span class="sr-only">(current)</span>
                    </a>
                </li>

                <br>

                <!-- Section "Dashboard"-->
                <li class="nav-item">
                    <a class="nav-link active" href="./dashboard.php">
                        <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                <!-- Section "Salespeople"-->
                <li class="nav-item">
                    <a class="nav-link active" href="./salespeople.php">
                        <span data-feather="home"></span>
                        Salespeople <span class="sr-only">(current)</span>
                    </a>
                </li>

                <!-- Section "Clients"-->
                <li class="nav-item">
                    <a class="nav-link active" href="./clients.php">
                        <span data-feather="home"></span>
                        Clients <span class="sr-only">(current)</span>
                    </a>
                </li>

                <!-- Section "Calls"-->
                <li class="nav-item">
                    <a class="nav-link active" href="./calls.php">
                        <span data-feather="home"></span>
                        Calls <span class="sr-only">(current)</span>
                    </a>
                </li>

                
            </ul>

            </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            
            '
            
            ;
            // Above is the generalized Header
            
            }?>

