<?php
    $param = $_POST["param"];
    $column = $_POST["col"];
    $mode = $_POST["mode"];

    $conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_query = "SELECT * FROM Flight WHERE $column = '$param';";
    $result = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($result) > 0) {       
        echo
        "
        <style>
            .flight_info {
                margin: 0 auto;
                background-image: radial-gradient( circle farthest-corner at 0.2% 0%,  rgba(238,9,121,1) 0%, rgba(255,106,0,1) 100.2% );
                border-radius: 25px;
                padding: 30px;
                padding-bottom: 15px;
                width 60vw;
                margin-top: 15px;
            }

            strong {
                text-transform: uppercase;
            }
        </style>
        ";

        while ($row = mysqli_fetch_assoc($result)) {
            echo 
            "<div id='flight" . $row['F_id'] . "' class='flight_info'>
                <input type='$mode' name='flight' value='" . $row['F_id'] . "' required><strong> ₹. " . $row['amount'] . "</strong>
                <p><strong>Flight ID: " . $row['F_id'] . "</strong></p>
                <p>Departing from <strong>" . $row['src'] . "</strong> on <strong>" . $row['depart_date'] . "</strong>, at <strong>" . $row['depart_time'] . "</strong></p>
                <p>Arriving at <strong>" . $row['des'] . "</strong> on <strong>" . $row['arrive_date'] . "</strong>, at <strong>" . $row['arrive_time'] . "</strong></p>
            </div>
            ";
        }
    }
    else {
        echo "1";
    }
    
    mysqli_close($conn);
?>