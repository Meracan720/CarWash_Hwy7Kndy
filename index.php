<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gary Chen">
        <meta name="last_update" content="2023-Sep-19">
        <meta name="description"
            content=" This is the index(content) page for all my lab works.">
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/style2023.css">

        <title> Nav Page 2100 - GaryC</title>

    </head>

    <body class="dark">
        <img src="./image/HONKAI_3.png" alt="Sample Loading Image">

        <header>
            <!-- Link Back to Main page-->
            <table style="width: 100%;">
            <tr>
                <td style="text-align: left; width:70%">
                    <h1> INFT 2100 - WebDev Intermediate </h1>
                    <p>*Latest update: November 23, 2023</p>
                    <p> Is PostgreSQL ready for this site?: <?php echo extension_loaded('pgsql') ? 'YES':'NO'; ?></p>
                </td>
                <td style="text-align: left; width:30%">
                    
                <!-- #region Refreshing Clock -->
                <h2>Date Now: </h2>
                    <div id="current_date"></div>
                    <script src="./functions/dateTime.js"></script>
                    <noscript> What's supposed to be here is a datetime clock.</noscript>
                </td>
                <!-- #endregion -->

            </tr>
            </table>
        </header>

        <!-- #region Main Code -->

        <hr><br>
        <h2>Links to different website versions:</h2>
        <ul style="margin: auto;">
        
            <!-- The latest Version         -->

            <li>
                <a href="./sign-in.php">Carwash Dashboard</a>
            <p>Ongoing Project</p>
            </li>

        
        </ul><br><br>
        <hr>

        <footer>
            <p>To Durham College main page click <a class="mini" href="https://durhamcollege.ca/">here</a>.</p>
            <p>© 2023 Gary C.</p>
    </footer>
    <!-- #endregion -->
    </body>

    <!-- Footer -->


</html>