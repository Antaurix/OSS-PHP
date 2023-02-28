<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // if the form has been submitted
    if (isset($_POST['submit'])) {

        // read the file data
        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));

        // build an sql statment to update the student details
        $sql = "INSERT INTO student(studentid,firstname,lastname,password,house,town,county,country,postcode,image) 
        VALUES('{$_POST['txtid']}','{$_POST['txtfirstname']}','{$_POST['txtlastname']}',
        '{$_POST['txtpassword']}','{$_POST['txthouse']}','{$_POST['txttown']}','{$_POST['txtcounty']}',
        '{$_POST['txtcountry']}','{$_POST['txtpostcode']}','$imgData')";

        // execute the query
        if (mysqli_query($conn, $sql)) {
            $data['content'] = "<p>The student has been added.</p>";
            header("Location: students.php");
        } else {
            $data['content'] = "<p>Error: " . mysqli_error($conn) . "</p>";
        }


    }
    else {
        // using <<<EOD notation to allow building of a multi-line string
        // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
        // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
        $data['content'] = <<<EOD

   <h2>Add Student</h2>
 <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
   ID:
   <input name="txtid" type="text" value="" /><br/>
   First Name :
   <input name="txtfirstname" type="text" value="" /><br/>
   Surname :
   <input name="txtlastname" type="text"  value="" /><br/>
   Password:
   <input name="txtpassword" type="password" value="" /><br/>
   Number and Street :
   <input name="txthouse" type="text"  value="" /><br/>
   Town :
   <input name="txttown" type="text"  value="" /><br/>
   County :
   <input name="txtcounty" type="text"  value="" /><br/>
   Country :
   <input name="txtcountry" type="text"  value="" /><br/>
   Postcode :
   <input name="txtpostcode" type="text"  value="" /><br/>
   Picture:
   <input  type="file" name="picture" accept="image/jpeg" class="form-control"  />
   <input type="submit" value="Save" name="submit"/>
   </form></form>

EOD;

    }

    // render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
