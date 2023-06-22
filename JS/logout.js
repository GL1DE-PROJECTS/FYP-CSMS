// Call the dataTables jQuery plugin
$(document).ready(function () {//#region Modal Create Account
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
});

function logout() {
    $.ajax({
      type: 'POST',
      url: '../PHP/logout.php',
      success: function (response) {
        if (response === 'success') {
          var temp = response;
          Swal.fire({
            title: 'Success!',
            text: 'Your Valid Credentials',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(function () {
            window.location.href = '../index.html';
          });
        } else {
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
