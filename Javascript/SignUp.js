function passid_validation(passid,mx,my)
{
    var passid_len = passid.length;
    if (passid_len == 0 ||passid_len >= my || passid_len < mx)
    {
        alert("Password should not be empty / length be between "+mx+" to "+my);
        passid.focus();
        return false;
    }
    return true;
}

function phone_no_validation(phone_no) {
    var phone_no_len = phone_no.length;
    if (phone_no_len == 0 || phone_no_len > 10 || phone_no_len < 10) {
        alert("Invalid Phone no");

    }
}

function formValidation() {
    var user_name = $("#username").val();
    var password_ = $("#password").val();
    var emailId = $("#email_id").val();
    var first_name_ = $('#first_name').val();
    var last_name_ = $('#last_name').val();
    var phone_no_ = $('#phone_no').val();
    var result = true;

    $(".error").remove();

    if (password_.length < 8 || password_.length > 16) {
        $('#password').after("<span class='error'>Invalid Password. Password should be between 8 to 16 characters long.</span>");
        result = false;
    }
    
    if (user_name.length < 1) {
        $("#username").after("<span class='error'>This field is required.</span>");
        result = false;
    }

    if (phone_no_.length > 10 || phone_no_.length < 10 || phone_no_.length == 0) {
        $("#phone_no").after("<span class='error'>Please Enter valid Phone No.</span>");
        result = false;
    }

    if (first_name_.length < 1) {
        $("#first_name").after("<span class='error'>This field is required.</span>");
        result = false;
    }

    if (last_name_.length < 1) {
        $("#last_name").after("<span class='error'>This field is required.</span>");
        result = false;
    }

    if (emailId.length < 1) {
        $("#email_id").after("<span class='error'>This field is required.</span>");
        result = false;
    }
    else {
        var regEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        var validEmail = regEx.test(emailId);
        if (!validEmail) {
            $("#email_id").after("<span class='error'>Please Enter valid Email ID</span>");
            result = false;
        }
    }
    
    return result;
}

$("#submit").click(function () {
    if (formValidation()) {
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
    }
});
$("#back").click(function () {
    loadSearch();
});