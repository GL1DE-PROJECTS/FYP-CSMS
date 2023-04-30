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

    // //#region JS for send Email
    // $('#email-form').submit(function(e) {
    //     e.preventDefault(); // Prevent the form from submitting normally
    
    //     // Get the form data
    //   const formData = $(this).serialize();
    //   const to = $('#recipient').val();
    //   // const subject = $('#subject').val();
    //   // const message = $('#message').val();
    
    //     // Send the AJAX request
    //     $.ajax({
    //       type: 'POST',
    //       url: '../PHP/send_email.php',
    //       data: {
    //         formData,
    //         to: to
    //       },
    //       success: function(response) {
    //         $('#response').html(response);
    //       },
    //       error: function() {
    //         $('#response').html('Failed to send email');
    //       }
    //     });
    //   });
    //#endregion

    $('#email-form').submit(function(e) {
      e.preventDefault();
      $.ajax({
          url: '../PHP/register.php',
          method: 'POST',
          data: $(this).serialize(),
          success: function(response) {
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
          },
          error: function(jqXHR, textStatus, errorThrown) {
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
    window.location.href = "../HTML/frmMainPage.html";
    return false;
}
