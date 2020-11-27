function InsertPassenger(index) {
    var c = "passenger" + index;
    var count = Number(index)+1;
    var div = document.createElement("div");
    div.className = c;
    $("#passengers_info").append(div);
    var first_name = document.createElement("input");
    first_name.type = "text";
    first_name.name = "first_name";
    first_name.placeholder = "PASSENGER " + (count);
    first_name.className = c + " pass_inputs";
    var last_name = document.createElement("input");
    last_name.type = "text";
    last_name.name = "last_name";
    last_name.placeholder = "PASSENGER " + (count);
    last_name.className = c + " pass_inputs";
    var Phone_No = document.createElement("input");
    Phone_No.type = "text";
    Phone_No.name = "Phone_No";
    Phone_No.placeholder = "PASSENGER " + (count);
    Phone_No.className = c + " pass_inputs";
    $("div." + c).append("<label class='labels'>FIRST NAME: <br></label>", first_name, "<br><label class='labels'>LAST NAME: <br></label>", last_name, "<br><label class='labels'>PHONE NUMBER: <br></label>", Phone_No);
    $("div." + c).addClass("pass_info_ind");
}

function Insert_Passengers() {
    passenger_ids = [];
    for (var i=0; i < n_passengers; i++) {
        var c = "passenger" + i;
        $.post("passengers.php",
        {
            first_name: $("input." + c + "[name='first_name']").val(),
            last_name: $("input." + c + "[name='last_name']").val(),
            Phone_No: $("input." + c + "[name='Phone_No']").val()
        },
        function (data) {
            $("body").append(data);
        });
    }
}

function InsertBookNowButton() {
    $("div.book_now").html("<div id='book_now_div'><button type='button' name='book_now' value='book_now' id='book_now'>book now!</button></div>");
    $("#book_now").click(function () {
        Insert_Passengers();
        loadpayment();
    });
}

function UpdateAmount() {
    amount = Number($("span.amount." + flight_go).html()) * n_passengers;
    if (trip_type == "return") {
        amount += Number($("span.amount." + flight_ret).html()) * n_passengers;
    }
}

$("document").ready(function() {
    $("#return_date").prop('disabled', true);
    $('input[type="radio"]').change(function() {
        if($(this).val() == "one_way"){
             $("#return_date").prop("disabled", true);
        }
        else {
            $("#return_date").prop("disabled", false);
        }
    });

    $(".fl_dropbox").change(function() {
        var selected_src = $("#src option:selected").val();
        var selected_des = $("#des option:selected").val();
        var thisID = $(this).prop("id");
        $(".fl_dropbox option").each(function() {
            $(this).prop("disabled", false);
        });
        $("#src").each(function() {
                $("option[value='" + selected_des + "']", $(this)).prop("disabled", true);
        });
        $("#des").each(function() {
                $("option[value='" + selected_src + "']", $(this)).prop("disabled", true);
        });
    });

    date1 = $("#depart_date").val();
    date2 = $("#return_date").val();
    document.getElementById("submit_button").disabled = true; 
    
    $(".dates").change(function() {
        date1 = $("#depart_date").val();
        date2 = $("#return_date").val();
        ret_disabled = $("#return_date").prop("disabled");
        if(Date.parse(date1) > Date.parse(date2) && !ret_disabled) {
            alert("Invalid dates. Please try again.");
            document.getElementById("submit_button").disabled = true; 
        } else {
            document.getElementById("submit_button").disabled = false; 
        }
    });

    $("#submit_button").click(function() {
        $(".pass_info").css('display', 'none');
        $.post("search.php",
        {
            depart_date: $("input[id='depart_date']").val(),
            src: $("select[id='src']").val(),
            des: $("select[id='des']").val(),
            trip_type: $("input[name='trip_type']:checked").val(),
            return_date: $("input[id='return_date']").val()
        },
        function (data) {
            $("div.result").html("");
            $("#passengers_info").html("");
            $("div.book_now").html("");
            $("div.result").html(data);
            trip_type = $("input[name='trip_type']:checked").val();
            
            var book_now = document.createElement('button');
            var button_text = document.createTextNode("Book Now");
            book_now.id = 'book_now';
            book_now.name = 'book_now';
            book_now.value = 'book_now';
            book_now.appendChild(button_text);
            
            $("input[name='flight_go']").click(function() {
                $("#passengers_info").html("");
                $(".pass_info").css("display", "inherit");
                flight_go = Number($("input[name='flight_go']:checked").attr('value'));
                if (trip_type == "return") {
                    if($("input[name='flight_ret']:checked").length > 0) {
                        n_passengers = Number($("select[id='passengers']").val());
                        for (var i=0; i<n_passengers; i++) {
                            InsertPassenger(String(i));
                        }
                        InsertBookNowButton();
                        UpdateAmount();
                    }
                }
                else {
                    n_passengers = Number($("select[id='passengers']").val());
                    for (var i=0; i<n_passengers; i++) {
                        InsertPassenger(String(i));
                    }
                    InsertBookNowButton();
                    UpdateAmount();
                }
            });

            $("input[name='flight_ret']").click(function () {
                $("#passengers_info").html("");
                $(".pass_info").css("display", "inherit");
                flight_ret = Number($("input[name='flight_ret']:checked").attr('value'));
                if($("input[name='flight_go']:checked").length > 0) {
                    n_passengers = Number($("select[id='passengers']").val());
                    for (var i=0; i<n_passengers; i++) {
                        InsertPassenger(String(i));
                    }
                    InsertBookNowButton();
                    UpdateAmount();
                }
            });
        });
    });
});