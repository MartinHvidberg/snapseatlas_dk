
<?php
//
// // Author: Martin Hvidberg
// // Last edit: 2023-04-07 / mh
//
/* Open mysqli connection */
// require 'db.php';  // defines $db, the data base connection
//
// if ($db->connect_errno) {
// 	echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
// }
// $db->set_charset("utf8");
//
// /* Select queries return a resultset */
// $sql = "SELECT * FROM `userbase` WHERE 1";
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
        </head>
        <body>
            <h1>PHP & DB test</h1>
            <h2> PHP test </h2>

            <?php
                $msg = "PHP";
                echo "This is $msg talking...";
            ?>

            <h2> DB test 1 (user) - Classic READ </h2>

            <?php
                /* Open mysqli connection */
                require 'db.php';  // defines $db, the data base connection

                if ($db->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
                }
                $db->set_charset("utf8");

                /* Select queries return a resultset */
                $sql = "SELECT * FROM `userbase` WHERE not email like '%@%'";  //  LIMIT 4
                if(!$result = $db->query($sql)){
                    echo 'something wrong with that sql statement ... [SELECT 0123]';
                    die('There was an error running the query [' . $db->error . ']');
                } else {
                    echo '<table  border="1" style="width:100%">';
                    echo '<tr><th>ID</th><th>Alias</th><th>Navn</th><th>email</th><th>kodeord</th><th>Status</th><th>Oprettet</th><th>Bekræftet</th><th>Note</th></tr>';
                    while($row = $result->fetch_assoc()){
                        echo '<tr><td>',$row['id'],'</td><td>',$row['name'],'</td><td>',$row['namefull'],'</td><td>',
                            $row['email'],'</td><td>',$row['kodeord'],'</td><td>',$row['status'],'</td><td>',
                            $row['registered'],'</td><td>',$row['confirmed'],'</td><td>',$row['note'],'</td></tr>';
                    }  // while
                    echo '</table>';
                }  // else
                /* free result set */
                $result->close();
                $db->close();
            ?>

            <h2>  DB test 1 (user) - Classic Write </h2>

             <?php
                /* Open mysqli connection */
                require 'db.php';  // defines $db, the data base connection

                if ($db->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
                }
                $db->set_charset("utf8");

                /* 1 - Insert Dummy record */
                echo "<p>* 1 - Insert Dummy record *</p>";
                $sql = "INSERT INTO `userbase`(`id`, `name`, `namefull`, `email`, `kodeord`, `status`, `registered`, `confirmed`, `note`)
                                    VALUES (0,\"Loejser Bandit\",\"L.M.F. Bandit\",\"lmfb@email.net\",\"kodeord\",-9,\"\",\"\",\"PHP TEST\")";
                if(!$result = $db->query($sql)){
                    echo 'something wrong with that sql statement ... [INSERT 1534]';
                    die('There was an error running the query [' . $db->error . ']');
                }

                /* 2 - Show Dummy record */
                echo "<p>* 2 - Show Dummy record *</p>";
                $sql = "SELECT * FROM `userbase` WHERE note like 'PHP TEST'";  //  LIMIT 4
                if(!$result = $db->query($sql)){
                    echo 'something wrong with that sql statement ... [SELECT 1534]';
                    die('There was an error running the query [' . $db->error . ']');
                } else {
                    echo '<table  border="1" style="width:100%">';
                    echo '<tr><th>ID</th><th>Alias</th><th>Navn</th><th>email</th><th>kodeord</th><th>Status</th><th>Oprettet</th><th>Bekræftet</th><th>Note</th></tr>';
                    while($row = $result->fetch_assoc()){
                        echo '<tr><td>',$row['id'],'</td><td>',$row['name'],'</td><td>',$row['namefull'],'</td><td>',
                            $row['email'],'</td><td>',$row['kodeord'],'</td><td>',$row['status'],'</td><td>',
                            $row['registered'],'</td><td>',$row['confirmed'],'</td><td>',$row['note'],'</td></tr>';
                    }  // while
                    echo '</table>';
                }  // else
                /* free result set */
                //$result->close();

                /* 3 - DELETE Dummy record */
                echo "<p>* 3 - DELETE Dummy record *</p>";
                $sql = "DELETE from userbase WHERE note like 'PHP TEST'";
                if(!$result = $db->query($sql)){
                    echo 'something wrong with that sql statement ... [DELETE 1553]';
                    die('There was an error running the query [' . $db->error . ']');
                } else  {
                    echo "<p>* 3 success DELETING *</p>";
                }
                /* free result set */
                //$result->close();
                //echo "<p>* 3 success Complete *</p>";

             ?>

             <?php

                /* 4 - Re-show Dummy record (there should ne None! ) */
                echo "<p>* 4 - Re-show Dummy record (there should ne None! ) *</p>";
                $sql = "SELECT * FROM `userbase` WHERE note like 'PHP TEST'";  //  LIMIT 4
                if(!$result = $db->query($sql)){
                    echo 'something wrong with that sql statement ... [SELECT 1612]';
                    die('There was an error running the query [' . $db->error . ']');
                } else {
                    echo '<table  border="1" style="width:100%">';
                    echo '<tr><th>ID</th><th>Alias</th><th>Navn</th><th>email</th><th>kodeord</th><th>Status</th><th>Oprettet</th><th>Bekræftet</th><th>Note</th></tr>';
                    while($row = $result->fetch_assoc()){
                        echo '<tr><td>',$row['id'],'</td><td>',$row['name'],'</td><td>',$row['namefull'],'</td><td>',
                            $row['email'],'</td><td>',$row['kodeord'],'</td><td>',$row['status'],'</td><td>',
                            $row['registered'],'</td><td>',$row['confirmed'],'</td><td>',$row['note'],'</td></tr>';
                    }  // while
                    echo '</table>';
                }  // else
                /* free result set */
                $result->close();
                $db->close();
                echo "<p>* 5 Done... *</p>";
             ?>


            <h2>  DB test 2 (plant) - Classic Read </h2>

            <?php
                /* Open mysqli connection */
                require 'db.php';  // defines $db, the data base connection

                if ($db->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
                }
                $db->set_charset("utf8");

                /* Select queries return a resultset */

                if(!$result = $db->query($sql)){
                    echo 'something wrong with that sql statement ... [SELECT 0123]';
                    die('There was an error running the query [' . $db->error . ']');
                } else {
                    echo '<table  border="1" style="width:100%">';
                    echo '<tr><th>ID</th><th>Alias</th><th>Navn</th><th>email</th><th>kodeord</th><th>Status</th><th>Oprettet</th><th>Bekræftet</th><th>Note</th></tr>';
                    while($row = $result->fetch_assoc()){
                        echo '<tr><td>',$row['id'],'</td><td>',$row['name'],'</td><td>',$row['namefull'],'</td><td>',
                            $row['email'],'</td><td>',$row['kodeord'],'</td><td>',$row['status'],'</td><td>',
                            $row['registered'],'</td><td>',$row['confirmed'],'</td><td>',$row['note'],'</td></tr>';
                    }  // while
                    echo '</table>';
                }  // else
                /* free result set */
                $result->close();
                $db->close();
            ?>



            <p> ------ End of test ------ </p>
        </body>
    </html>