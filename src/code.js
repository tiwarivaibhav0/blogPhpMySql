$(document).ready(function () {
  (function () {
    "use strict";

    var forms = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add("was-validated");
        },
        false
      );
    });
  })();
  $("#Register").on("submit", function (e) {
    e.preventDefault();

    var email = $("#floatingemail").val();
    var fname = $("#floatingfname").val();
    var lname = $("#floatinglname").val();

    var checkUsername = $("#floatingusername").val();
    var password = $("#floatingPassword").val();
    var password2 = $("#floatingPassword2").val();
    var User_type = "user";
    var city = $("#floatingcity").val();
    var country = $("#floatingcountry").val();
    var pin = $("#floatingpin").val();
    var data = JSON.stringify($(this).serialize());

    $.ajax({
      url: "server.php",
      type: "POST",
      data: { checkEmail: email, checkUsername: checkUsername },
      dataType: "text",
      success: function (result) {
        if (result == 0) {
          $("#reg").html("<strong>Email already in use</strong>");
        } else if (result == 1) {
          $("#reg").html("<strong>Username is already taken</strong>");
        } else {
          if (password == password2) {
            if (
              fname != "" &&
              lname != "" &&
              email != "" &&
              password != "" &&
              User_type != "" &&
              city != "" &&
              country != "" &&
              pin != ""
            ) {
              alert("Successfully Registerd!");
              $.ajax({
                url: "server.php",
                type: "POST",
                data: { data: data, User_type: User_type },
                dataType: "text",
                success: function (result) {
                  console.log(result);
                  // $("#result").html(result);
                  // alert("Successfully Registered");
                  window.location = "login.php";
                  // location.reload();
                },
                error: function () {},
              });
            } else {
              $("#Warning").html("<strong>All Fields are mandatory *</strong>");
            }
          } else {
            $("#reg").html("<strong>Passwords didn't match</strong>");
          }
        }
      },
      error: function () {},
    });
  });
  $(document).on("keyup", "#floatingPassword", function () {
    $("#reg").html("");
  });
  $(document).on("keyup", "#floatingPassword2", function () {
    $("#reg").html("");
  });
  $(document).on("keyup", "#floatingemail", function () {
    $("#reg").html("");
  });
  $(document).on("keyup", "#floatingusername", function () {
    $("#reg").html("");
  });
  $("#Signin").on("submit", function () {
    //  e.preventDefault();
    var email = $("#loginEmail").val();
    var password = $("#loginPassword").val();
    var remember = document.getElementById("remember");
    if (remember.checked) {
      remember = 1;
    } else remember = 0;
    //  console.log(fname,lname,email,password,User_type);
    if (email != "" && password != "")
      $.ajax({
        url: "server.php",
        type: "POST",
        data: {
          loginEmail: email,
          loginPassword: password,
          remember: remember,
        },
        dataType: "text",
        success: function (result) {
          console.log(result);
          if (result != 0) window.location = "home.php";
          else {
            $("#reg").html("Invalid username or password</strong>");
          }
        },
        error: function () {},
      });
  });
});
