<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");
    echo"</br></br></br>";

    // Escape user input
    $studentId = mysqli_real_escape_string($conn, $_SESSION['id']);

    // Build SQL statment that selects all the students details from the database.
    $sql = "select * from student";

    $result = mysqli_query($conn,$sql);

    // Create the add form and button to add students to the database.
    $data['content'] .="<form action='addstudent.php' method='POST'>";
    $data['content'] .= "<input type='submit' name='addbtn' class='btn btn-success' value='Add'/>";
    $data['content'] .= "</form>";

    // Send delete request from the form to the deletestudents.php.
    $data['content'] .="<form action='deletestudents.php' method='POST'>";

    // prepare page content
    $data['content'] .= "<table class='table table-secondary' border='1'>";
    $data['content'] .= "<tr><th colspan='9' align='center'>Details</th></tr>";
    $data['content'] .= "<tr><th>ID</th><th>First name</th><th>Last name</th><th>D.O.B</th>
<th>House</th><th>Town</th><th>Country</th><th>Postcode</th><th>Image</th></tr>";
    // Display the student details within the html table
    while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td> {$row["studentid"]} </td>";
        $data['content'] .= "<td> {$row["firstname"]} </td>";
        $data['content'] .= "<td> {$row["lastname"]} </td>";
        $data['content'] .= "<td> {$row["dob"]} </td>";
        $data['content'] .= "<td> {$row["house"]} </td>";
        $data['content'] .= "<td> {$row["town"]} </td>";
        $data['content'] .= "<td> {$row["country"]} </td>";
        $data['content'] .= "<td> {$row["postcode"]} </td>";
        $data['content'] .= "<td><img src='data:image/jpeg;base64," . base64_encode($row["image"]) ."' with='100'
        height='100'/></td>";
        $data['content'] .= "<td><input type='checkbox' name='students[]' value='$row[studentid]' /></td>";
        $data['content'] .= "</tr>";
    }
    $data['content'] .= "</table>";

    // Create the delete button
    $data['content'] .= "<input type='submit' name='deletebtn' class='btn btn-danger' value='Delete'/>";
    // Close the forms
    $data['content'] .= "</form>";
    // render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
