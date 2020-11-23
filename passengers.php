<?php

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$Phone_No = $_POST['Phone_No'];

$conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");

if (!$conn) {
    die("Connection Failed" . mysqli_connect_error());
}

$sql_query = "SELECT P_id FROM Passengers WHERE first_name='$first_name' AND last_name='$last_name' AND Phone_No='$Phone_No';";

$result = mysqli_query($conn, $sql_query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $Passenger_id = $row["P_id"];
    }
}
else {
    $sql_query = "INSERT INTO Passengers (first_name, last_name, Phone_No) VALUES ('$first_name', '$last_name', $Phone_No);";
    if (mysqli_query($conn, $sql_query)) {
        $sql_query = "SELECT P_id FROM Passengers WHERE first_name='$first_name' AND last_name='$last_name' AND Phone_No='$Phone_No';";
        $result = mysqli_query($conn, $sql_query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Passenger_id = $row["P_id"];
            }
        }
    }
    else {
        echo "Invalid Input";
    }
}

echo "<script>passenger_ids.push('$Passenger_id')</script>";

mysqli_close($conn);

?>