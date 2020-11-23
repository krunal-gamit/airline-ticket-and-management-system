$("#submit").click(function () {
    $.post("SignUp.php",
    {
        username: $("#username").val(),
        password: $("#password").val(),
        email_id: $("#email_id").val()
    },
    function(data) {
        $("div.result").html(data);
    });
});
$("#back").click(function () {
    loadSearch();
});