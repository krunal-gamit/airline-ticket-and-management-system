<?php
    $flights = $_POST["flights"];
    $length = count($flights);

    $conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    for ($i = 0; $i < $length; $i++) {
        $sql_query = "DELETE FROM Flight WHERE F_id = " . $flights[$i] . ";";
        $result = mysqli_query($conn, $sql_query);
        if ($result) { 
            echo "<p class='labels'>Flight " . $flights[$i] . " removed.</p>";
        } else {
            $error = mysqli_error($conn);
            echo "<p class='labels'>ERROR: $error</p>";
        }
    }
    
    mysqli_close($conn);
?>