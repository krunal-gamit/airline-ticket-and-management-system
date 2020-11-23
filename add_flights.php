<?php
    $src = $_POST["src"];
    $des = $_POST["des"];
    $depart_date = $_POST["depart_date"];
    $arrive_date = $_POST["arrive_date"];
    $depart_time = $_POST["depart_time"];
    $arrive_time = $_POST["arrive_time"];
    $airplane_name = $_POST["airplane_name"];
    $noOfSeats = $_POST["seats_no"];
    $amount = $_POST["amount"];
    
    $conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_query = "INSERT INTO Flight (src, des, depart_time, arrive_time, depart_date, arrive_date, airplane_name, noOfSeats, amount) VALUES ('$src', '$des', '$depart_time', '$arrive_time', '$depart_date', '$arrive_date', '$airplane_name', $noOfSeats, $amount);";

    if (mysqli_query($conn, $sql_query)) {
        echo "1";
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }

    mysqli_close($conn);
 ?>
