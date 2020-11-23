<?php

$conn = mysqli_connect("localhost", "root", "", "Ticket_Booking");

if (!$conn) {
    die("Connectioecho " . $sql_query . ";n Failed" . mysqli_connect_error());
}

echo "
<style>



#list {
    
    position: relative;
    top: 240px;
    margin: 0 auto;
    border-collapse: collapse;
    border-radius: 30px;
    overflow: hidden;
}

.labels {
    font-weight: 800;
}

.list_item {
    color: black;
    background-image: radial-gradient( circle farthest-corner at 2.9% 7.7%,  rgba(164,14,176,1) 0%, rgba(254,101,101,1) 90% );
}

td, th {
    text-align: center;
    width: 10.5vw;
    padding: 25px 7.5px;
}
</style>

<table id='list'>
    <tr class='list_item'>
        <th class='labels'>FLIGHT ID</th>
        <th class='labels'>FROM</th>
        <th class='labels'>TO</th>
        <th class='labels'>DEPARTURE DATE</th>
        <th class='labels'>DEPARTURE TIME</th>
        <th class='labels'>ARRIVAL DATE</th>
        <th class='labels'>ARRIVAL TIME</th>
        <th class='labels'>PRICE (₹)</th>
    </tr>";

$sql_query = "SELECT * FROM Flight;";
$result = mysqli_query($conn, $sql_query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $flight_id = $row['F_id'];
        $src = $row['src'];
        $des = $row['des'];
        $depart_date = $row['depart_date'];
        $depart_time = $row['depart_time'];
        $arrive_date = $row['arrive_date'];
        $arrive_time = $row['arrive_time'];
        $amount = $row['amount'];

        echo "
        <tr class='list_item'>
            <td>$flight_id</td>
            <td>$src</td>
            <td>$des</td>
            <td>$depart_date</td>
            <td>$depart_time</td>
            <td>$arrive_date</td>
            <td>$arrive_time</td>
            <td>$amount</td>
        </tr>";
    }
}

echo "</table>";

mysqli_close($conn);
?>