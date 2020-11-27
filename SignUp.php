<?php

$username = $_POST["username"];
$password = $_POST["password"];
$email_id = $_POST["email_id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$phone_no = $_POST["phone_no"];

$conn = mysqli_connect("localhost:3306", "devuser", "password", "Ticket_Booking");

if (!$conn) {
    die("Connection Failed" . mysqli_connect_error());
}

$sql_query = "INSERT INTO Users (first_name, last_name, phone_no, username, password, email_id) VALUES ('$first_name', '$last_name', '$phone_no', '$username', '$password', '$email_id');";

if (mysqli_query($conn, $sql_query)) {
    echo "<p style='margin-left: 70px; color: black; 
                            position: relative; top: -90px; font-weight: 500;'>SIGN UP SUCCESSFUL.</p>";
} else {
    $error = mysqli_error($conn);
    echo "<p style='margin-left: 70px; color: black; 
                            position: relative; top: -90px; font-weight: 500;'>ERROR $sql_query: $error</p> ";
}

mysqli_close($conn);

?>
