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

$result = mysqli_query($conn, $sql_query);
if ($result) {
    $sql_query = "SELECT * FROM Payment;";
    $result = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $payment_id = $row["P_id"];
            echo "<div>" . $row["P_id"] . " " . $row["mode"] . " " . $row["amount"] . " " . $row["user_id"] . "</div>"; 
        }
    }
    echo "<div>" . $payment_id . "</div>";
}
else {
    echo "Payment Failed";
}

mysqli_close($conn);

?>