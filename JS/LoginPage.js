$(document).on('mousewheel', function(e) {
    if (e.ctrlKey) {
      var scale = $('body').css('transform') || 'scale(1)';
      scale = scale.replace('scale(', '').replace(')', '');
      scale = parseFloat(scale) + (e.originalEvent.deltaY > 0 ? -0.1 : 0.1);
      $('body').css('transform', 'scale(' + scale + ')');
    }
  });
   

$(document).ready(function () {
    
    //#region Modal Create Account
    $("#myBtn").click(function () {
        $("#Modal-Account").css("display", "block");
    });

    $(".close").click(function () {
        $("#Modal-Account").css("display", "none");
        $('#email-form')[0].reset();
        $('#recoverPass')[0].reset();
    });

    $(window).click(function (event) {
        if (event.target == document.getElementById("myModal")) {
            $("#Modal-Account").css("display", "none");
        }
    });
    //#endregion

    //#region Modal Forgot Password
    $("#btnFgtPwd").click(function () {
        $("#Modal-ForgotPwd").css("display", "block");
    });

    $(".close").click(function () {
        $("#Modal-ForgotPwd").css("display", "none");
    });

    $(window).click(function (event) {
        if (event.target == document.getElementById("myModal")) {
            $("#Modal-ForgotPwd").css("display", "none");
        }
    });
    //#endregion

  $('#email-form').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: './PHP/register.php',
      method: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        if (response == "Data inserted successfully")
        {
          Swal.fire({
            title: 'Success!',
            text: 'Your data has been submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(function () {
            console.log(response);
            $('#email-form')[0].reset();
            // Do something on success
            // Redirect to a different page or do something else
            // after the user clicks "OK"
            $("#Modal-Account").css("display", "none");
          });
        }
        else
        {
          console.log(textStatus, errorThrown);
          // Do something on error
          Swal.fire({
            title: 'Error!',
            text: 'There was an error submitting your data.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        // Do something on error
        Swal.fire({
          title: 'Error!',
          text: 'There was an error submitting your data.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    });
  });

  $('#recoverPass').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: './PHP/recoverPass.php',
      method: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        if (response == "success")
        {
          Swal.fire({
            title: 'Success!',
            text: 'Your data has been submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(function () {
            console.log(response);
            $('#recoverPass')[0].reset();
            // Do something on success
            // Redirect to a different page or do something else
            // after the user clicks "OK"
            $("#Modal-Account").css("display", "none");
          });
        }
        else if(response == "No user")
        {
          console.log(response);
          // Do something on error
          Swal.fire({
            title: 'Error!',
            text: 'No user found with the username/email',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
        else
        {
          console.log(response);
          // Do something on error
          Swal.fire({
            title: 'Error!',
            text: 'There was an error submitting your data.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        // Do something on error
        Swal.fire({
          title: 'Error!',
          text: 'There was an error submitting your data.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    });
  });
});



function toMainPage() {
  var username = $('input[type="text"]').val();
  var password = $('input[type="password"]').val();

  $.ajax({
    type: 'POST',
    url: './PHP/checkLogin.php',
    data: { username: username, password: password },
    success: function (response) {
      if (response === 'success1') {
        console.log(response);
        var temp = response;
        Swal.fire({
          title: 'Success!',
          text: 'Your Valid Credentials',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(function () {
          window.location.href = './PHP/approveUser.php';
        });
      }
      else if (response === 'success2')
      {
        console.log(response);
        var temp = response;
        Swal.fire({
          title: 'Success!',
          text: 'Your Valid Credentials',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(function () {
          window.location.href = './PHP/Main.php';
        });
      }
      else if (response === 'success3')
      {
        console.log(response);
        var temp = response;
        Swal.fire({
          title: 'Success!',
          text: 'Your Valid Credentials',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(function () {
          window.location.href = './PHP/Main.php';
        });
      }
      else {
        console.log(response);
        var temp = response;
        Swal.fire({
          title: 'MASALAH DUNIA!',
          text: 'There was an error',
          icon: 'error',
          confirmButtonText: 'YE LAHH'
        });
      }
    }
  });
}
