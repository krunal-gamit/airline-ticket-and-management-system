<?php
    $flight_id = $_POST["flight_id"];
    $new_price = $_POST["new_price"];

    $conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_query = "UPDATE Flight SET amount = $new_price WHERE F_id = $flight_id;";
    $result = mysqli_query($conn, $sql_query);

    if ($result) {
        echo "1";
    } else {
        $error = mysqli_error($conn);
        echo "<p class='labels'>ERROR: $error</p>";
    }

    mysqli_close($conn);
?>