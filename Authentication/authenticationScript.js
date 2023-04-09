$("#emailResetButton").on("click", function (e) {
    e.preventDefault();
    debugger;
    var button = $(this);
    button.prop("disabled", true);
    check = true;
    // if (!checkEmail(email, $("#Email").siblings("span"))) {
    //   check = false;
    // }

    // if (!checkStrength(password, $("#Password").siblings("span"))) {
    //   check = false;
    // }
    if (!($("#Email").keyup())) {
      check = false;
    }

    console.log("Debugging");
    if (check) {
      var data = $("#resetPassword").serialize();
      console.log(data);
      if (check) {
        console.log(data);
        $.ajax({
          url: "completeEmailForReset.php",
          type: "POST",
          data: data,
          success: function (response) {
            debugger;
            //alert("Mbaruam")
            //alert(response);
            var rez = JSON.parse(response);
            console.log(response);
            button.prop("disabled", false);
            if (rez.Return == true) {
              window.location.href = "CodeResetAF.php";
            } else {
              alert(rez.Message);
            }
          },
          error: function (response) {
            alert(response.Message);
            button.prop("disabled", false);
          }
        })
      } else {
        button.prop("disabled", false);
        alert("Ka gabime ne forme");
      }
    }
    else {
      button.prop("disabled", false);
      alert("Ka gabime ne forme");
    }
  });