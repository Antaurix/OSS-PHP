<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

    foreach ($_POST['students'] as $value){


    // Build SQL statment that selects all the students details from the database.
    $sql = "DELETE FROM student WHERE studentid='$value'";

    $result = mysqli_query($conn,$sql);

    //Redirect back to students table.
    header("Location: students.php");
    }
}
else {
    header("Location: students.php");
}


?>
