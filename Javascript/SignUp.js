$("#submit").click(function () {
    $.post("SignUp.php",
    {
        username: $("#username").val(),
        password: $("#password").val(),
        email_id: $("#email_id").val(),
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val(),
        phone_no: $('#phone_no').val()
    },
    function(data) {
        $("div.result").html(data);
    });
});
$("#back").click(function () {
    loadSearch();
});