var username = "";
var user_id = 0;
var password = "";
var amount = 0;
var payment_id = 0;
var passenger_ids = [];
var n_passengers = 0;
var flight_go = 0;
var flight_ret = 0;
var trip_type = "";

function loadSearch() {
    $.get("search.html", function(data) {
        $("div.body").html(data);
    });
}

var leaveHandler = function(){
   $("#div1").hide();
};

function loadUser() {
    if (username.length === 0) {
        $("div.logout").hide();
        $("#display_username").hide();
        $("div.login").show();
        $("div.signup").show();
        $("div.admin").hide();
        $("div.bookedTickets").hide();
    }
    else {
        $("div.logout").show();
        $("#display_username").show();
        $("div.login").hide();
        $("div.signup").hide();
        if (username == "adminTest") {
            $("div.admin").show();
        }
        $("div.bookedTickets").show();
    }
    $("#display_username").text(username);
}


function loadlogin() {
    $.get("login.html", function (data) {
        $("div.body").html(data);
    });
}

function loadsignup() {
    $.get("SignUp.html", function (data) {
        $("div.body").html(data);
    });
}

function loadpayment() {
    $.get("payment.html", function (data) { 
        $("div.body").html(data);
    });
}

function checklogin() {
    if (username.length == 0) {
        loadlogin();
    }
}

function loadadmin() {
    $.post("admin.php",
    {
        submit: "submit"
    },
    function (data) {
        $("div.body").html(data);
    });
}

function loadBookedTickets() {
    $.post("BookedTickets.php",
    {
        user_id: user_id
    },
    function(data) {
        $("div.body").html(data);
        var noOfFlight = Number($("#noOfFlight").text());
        var i;
        for (i = 1; i <= noOfFlight; i++) {
            // var ticket_id = Number($("div.ticket_container." + i + " label.ticket_id").text());
            // var payment_id = Number($("div.ticket_container." + i + " label.payment_id").text());
            $("button."+ i).click(function () {
                id = Number($(this).attr('class'));
                ticket_id = Number($("label.ticket_id." + id).text());
                payment_id = Number($("label.payment_id." + id).text());
                cancelTicket(ticket_id, payment_id);
                loadBookedTickets();
            });
        }
    });
}

function cancelTicket(ticket_id, payment_id) {
    $.post("cancelTickets.php",
    {
        ticket_id: ticket_id,
        payment_id: payment_id
    }, 
    function(data) {
        $("div.body").append(data);
    });
}

$(document).ready(function () {
    $.get("logo.html", function(data) {
        $("div.logo").html(data);
    });
    loadSearch();
    loadUser();
    $("#login").click(function() {
        loadlogin();
        loadUser();
    });
    $("#signup").click(function() {
        loadsignup();
        loadUser();
    });

    $("#logout").click(function() {
        username = "";
        user_id = 0;
        password = "";
        loadUser();
        loadSearch();
        $(".back_srch").css("display", "none");
    });

    $("#admin").click(function() {
        loadadmin();
        $(".back_srch").css("display", "none");
        $("div.bookedTickets button[name='bookedTickets']").css("display", "inherit");
    });

    $("div.bookedTickets button[name='bookedTickets']").click(function () {
        loadBookedTickets();
        $("div.bookedTickets button[name='bookedTickets']").css("display", "none");
        $(".back_srch").css("display", "inherit");
    });

    $(".back_srch").click(function() {
        loadSearch();
        $(".back_srch").css("display", "none");
        $("div.bookedTickets button[name='bookedTickets']").css("display", "inherit");
    });
});