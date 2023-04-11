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

    //#region JS for send Email
    $('#email-form').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally
    
        // Get the form data
        const formData = $(this).serialize();
    
        // Send the AJAX request
        $.ajax({
          type: 'POST',
          url: 'send-email.php',
          data: formData,
          success: function(response) {
            $('#response').html(response);
          },
          error: function() {
            $('#response').html('Failed to send email');
          }
        });
      });
    //#endregion
});

function toMainPage() {
    window.location.href = "../HTML/frmMainPage.html";
    return false;
}
