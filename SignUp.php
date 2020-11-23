<?php

$username = $_POST["username"];
$password = $_POST["password"];
$email_id = $_POST["email_id"];

$conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");

if (!$conn) {
    die("Connection Failed" . mysqli_connect_error());
}

$sql_query = "INSERT INTO Users (username, password, email_id) VALUES ('$username', '$password', '$email_id');";

if (mysqli_query($conn, $sql_query)) {
    echo "<p style='margin-left: 70px; color: white; 
                            position: relative; top: -90px; font-weight: 500;'>SIGN UP SUCCESSFUL.</p>";
} else {
    $error = mysqli_error($conn);
    echo "<p style='margin-left: 70px; color: white; 
                            position: relative; top: -90px; font-weight: 500;'>ERROR $sql_query: $error</p> ";
}

mysqli_close($conn);

?>
