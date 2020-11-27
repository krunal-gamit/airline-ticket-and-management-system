$("#submit").click(function() {
    $.post("login.php",
    {
        username: $("#username").val(),
        password: $("#password").val()
    },
    function(data) {
        if (data == "1") {
            $("div.result").html("<p style='margin-left: 70px; color: black; position: relative; top: -90px; font-weight: 500;'>INVALID PASSWORD.</p>");
        } else if (data == "2") {
            $("div.result").html("<p style='margin-left: 70px; color: black; position: relative; top: -90px; font-weight: 500;'>USER DOES NOT EXIST, PLEASE SIGN UP FIRST.</p>");
        } else {
            $("div.result").html(data);
            username = $("#username").val();
            password = $("#password").val();
            loadUser();
            loadSearch();
            loadSearch();
        }
    });
});

$("#back").click(function () {
    loadUser();
    loadSearch();
    loadSearch();
});

