<?php

$ticket_id = $_POST['ticket_id'];
$payment_id = $_POST['payment_id'];

$conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");
    
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_query1 = "DELETE FROM Ticket WHERE T_id=" . $ticket_id . "";
$result1 = mysqli_query($conn, $sql_query1);

if (!$result1) {
    echo mysqli_error($conn);
    echo $sql_query1;
}

$sql_query2 = "DELETE FROM Payment WHERE P_id=" . $payment_id . "";
$result2 = mysqli_query($conn, $sql_query2);

if (!$result2) {
    echo mysqli_error($conn);
    echo $sql_query2;
}

mysqli_close($conn);

?>