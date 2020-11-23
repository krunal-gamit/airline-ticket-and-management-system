function loadSearch() {
    $.get("search.html", function(data) {
        $("div.body").html(data);
    });
}

function BookTicket(F_id) {
    for (var i = 0; i < n_passengers; i++) {
        $.post("BookTickets.php",
        {
            passenger_id: passenger_ids[i],
            flight_id: F_id,
            payment_id: payment_id
        },
        function (data) {
            $("div.result").append(data);
        });
    }
}

$(document).ready(function () {
    $("#mode").change(function() {
        $("#mode_info").css("display", "inherit");
        $("#cards").css("display", "none");
        $("#net_banking").css("display", "none");
        $("#ewallets").css("display", "none");

        if ($("#mode option:selected").val() == "credit card" || $("#mode option:selected").val() == "debit card") {
            $("#cards").css("display", "flex");
        } else if ($("#mode option:selected").val() == "ewallets") {
            $("#ewallets").css("display", "flex");
        } else if ($("#mode option:selected").val() == "netbanking") {
            $("#net_banking").css("display", "flex");
        }
    });

    $("span[name='amount']").append(amount);
    $("input[name='user_id']").attr('value', user_id);
    $("#pay").click(function() {
        $.post("payment.php",
        {
            mode : $("#mode option:selected").val(),
            amount : amount,
            user_id : user_id
        },
        function (data) {
            $("div.result").html(data);
            $("#back_to_search_div").css("display", "inherit");
            $("#search").click(function() {
                loadSearch();
            })
            BookTicket(flight_go);
            if (trip_type == "return") {
                BookTicket(flight_ret);
            }
        });
    });
    $("#cancel").click(function() {
        loadSearch();
    });
});