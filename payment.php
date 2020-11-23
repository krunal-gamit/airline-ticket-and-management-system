<?php

$mode = $_POST["mode"];
$amount = $_POST["amount"];
$user_id = $_POST["user_id"];
$payment_id = 0;

$conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");

if (!$conn) {
    die("Connection Failed" . mysqli_connect_error());
}

$sql_query = "INSERT INTO Payment (mode, amount, user_id) VALUES ('$mode', $amount, $user_id);";

if (mysqli_query($conn, $sql_query)) {
    $sql_query = "SELECT P_id FROM Payment;";
    $result = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $payment_id = $row["P_id"];
        }
    }
    echo "<script>payment_id = " . $payment_id . "</script>";
}
else {
    echo "<p class='labels' style='text-align: center'>PAYMENT FAILED.</p>";
}

mysqli_close($conn);
?>