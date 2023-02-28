<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// database connection
$conn = mysqli_connect("localhost", "root", "", "assignment2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// array of first names
$firstnames = array('Jon', 'Bob', 'Stewart', 'Max', 'Tom');
$lastnames = array('Smith','Willies','White','Stephenson','Jackson');

// loop to insert 5 student records
for ($i = 1; $i <= 5; $i++) {
    // generate random data
    $studentid = 'ST' . str_pad($i, 6, '0', STR_PAD_LEFT);
    $password = password_hash('password123', PASSWORD_DEFAULT);
    $dob = date('Y-m-d', strtotime('-'.mt_rand(18, 25).' years'));
    $random_firstname = $firstnames[array_rand($firstnames)];
    $random_lastname = $lastnames[array_rand($lastnames)];
    $house = mt_rand(1, 100);
    $town = 'London';
    $county = 'Greater London';
    $country = 'United Kingdom';
    $postcode = 'SW1A 1AA';

    // insert student record
    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('$studentid', '$password', '$dob', '$random_firstname', '$random_lastname', '$house', '$town', '$county', '$country', '$postcode')";
    if ($conn->query($sql) === TRUE) {
        echo "Record $i inserted successfully<br>";
    } else {
        echo "Error inserting record $i: " . $conn->error."<br>";
    }
}

$conn->close();
?>
