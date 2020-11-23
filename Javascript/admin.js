function loadListFlights() {
    $.get("list_flights.php", function(data) {
        $("#container").html(data);
    });
}

function loadAddFlights() {
    $.get("add_flights.html", function(data) {
        $("#container").html(data);
    });
}

function loadRemoveFlights() {
    $.get("remove_flights.html", function(data) {
        $("#container").html(data);
    });
}

function loadChangePrices() {
    $.get("change_prices.html", function(data) {
        $("#container").html(data);
    });
}

$(document).ready(function() {
    $("#user_id").append(username);
    
    $("#list_flights_button").click(function() {
        loadListFlights();
    });
    
    $("#add_flights_button").click(function() {
        loadAddFlights();
    });

    $("#remove_flights_button").click(function() {
        loadRemoveFlights();
    });

    $("#change_prices_button").click(function() {
        loadChangePrices();
    });

    $("#search_page_button").click(function() {
        loadSearch();
    });
});