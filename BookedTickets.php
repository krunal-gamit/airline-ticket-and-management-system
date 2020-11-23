<?php

$user_id = $_POST['user_id'];
$payment_id = "";
$ticket_id = "";
$passenger_id = "";
$flight_id = "";
$src = "";
$des = "";
$depart_time = "";
$depart_date = "";
$arrive_time = "";
$arrive_date = "";
$amount = "";
$first_name = "";
$last_name = "";

$conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");

if (!$conn) {
    die("Connectioecho " . $sql_query . ";n Failed" . mysqli_connect_error());
}

$sql_query1 = "SELECT P_id FROM Payment WHERE user_id=" . (int)$user_id . "";
$result1 = mysqli_query($conn, $sql_query1);

echo "
<style> 
*{
    font-family: Lexend Deca;
    color: black;
}


div.ticket_container { 
    background-color: #202020; 
    width: 75vw; 
    margin: 15px auto; 
    border-radius: 25px;
    padding: 25px;
    // padding-bottom: 10px;
    background-color:white;
}


div.ticket_container { 
  box-shadow:
  0 2.8px 2.2px rgba(0, 0, 0, 0.004),
  0 -6.7px 5.3px rgba(0, 0, 0, 0.008),
  0 -12.5px 10px rgba(0, 0, 0, 0.006),
  0 22.3px 17.9px rgba(0, 0, 0, 0.022),
  0 -22.3px 17.9px rgba(0, 0, 0, 0.022),
  0 41.8px 33.4px rgba(0, 0, 0, 0.036)

}



#ticket {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin-bottom: 25px;
} 

#depart_from, #arrive_at {
    text-align  : center;
    font-family: Lexend Deca;
    font-weight:light;
}

.city {
    font-family: Raleway;
    text-transform: uppercase;
    font-weight: bolder;
    font-size: 22.5px;
}

.date {
    font-family:Lexend Deca;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 20px;
}

.time {
    text-transform: uppercase;
    font-weight: bolder;
    font-size: 20px;
}

#cancel_booking {
    font-family: Lexend Deca;
    margin-top: 15px;
    background-color: transparent;
    border-width: 0px;
    font-weight: 400;
    font-size: 15px;
    transition-duration: 0.2s;
    color: #e51937;
}

#cancel_booking:hover {
    transform: scale(1.05);
    font-weight: 800;
}
</style>";
$i = 0;
if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $payment_id = $row1['P_id'];

        $sql_query2 = "SELECT * FROM Ticket WHERE payment_id=" . (int)$payment_id . "";
        $result2 = mysqli_query($conn, $sql_query2);

        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $i = $i + 1;
                $ticket_id = $row2['T_id'];
                $passenger_id = $row2['passenger_id'];
                $flight_id = $row2['flight_id'];

                $sql_query3 = "SELECT * FROM Flight WHERE F_id=" . (int)$flight_id . "";
                $result3 = mysqli_query($conn, $sql_query3);

                if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $src = $row3['src'];
                        $des = $row3['des'];
                        $depart_date = $row3['depart_date'];
                        $depart_time = $row3['depart_time'];
                        $arrive_date = $row3['arrive_date'];
                        $arrive_time = $row3['arrive_time'];
                        $amount = $row3['amount'];
                    }
                }

                $sql_query4 = "SELECT * FROM Passengers WHERE P_id=" . (int)$passenger_id . "";
                $result4 = mysqli_query($conn, $sql_query4);

                if (mysqli_num_rows($result4) > 0) {
                    while ($row4 = mysqli_fetch_assoc($result4)) {
                        $first_name = $row4['first_name'];
                        $last_name = $row4['last_name'];
                    }
                }

                echo "
                <div class='ticket_container " . $i . "'>
                    <div id='ticket'>
                        <div id='depart_from'>
                            DEPARTING FROM <label class='city'> " . $src . "</label><br>
                            ON <label class='date'> " . $depart_date . "</label><br>
                            AT <label class='time'> " . $depart_time . "</label><br>
                        </div>
                
                        <div id='arrive_at'>
                            ARRIVING AT <label class='city'> " . $des . "</label><br>
                            ON <label class='date'> " . $arrive_date . "</label><br>
                            AT <label class='time'> " . $arrive_time . "</label><br>
                        </div>
                    </div>
                    <div style='margin-top:15px;text-align:center;'><b>PASSENGER: </b>" . $first_name . " " . $last_name . "</div>
                    <div style='margin-top:15px;text-align:center;display:none;'>Ticket ID: <label class='ticket_id " . $i . "'>" . $ticket_id . "</label></div>
                    <div style='margin-top:15px;text-align:center;display:none;'>Payment ID: <label class='payment_id " . $i . "'>" . $payment_id . "</label></div>
                    <div style='text-align:center;' id='cancel_booking_div'><button class='" . $i . "' id='cancel_booking'><b>CANCEL BOOKING</b></button></div>
                </div>";
            }
        }
    }
}
else {
    echo "<h3 style='text-align: center;'>NO TICKETS BOOKED YET.</h3>";
}

echo "<div id='noOfFlight' hidden>" . $i . "</div>";

mysqli_close($conn);

?>