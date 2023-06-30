$(document).ready(function () {
    $('#userForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
          url: '../PHP/updateUser.php',
          method: 'POST',
          data: $(this).serialize(),
          success: function (response) {
            Swal.fire({
              title: 'Success!',
              text: 'Your data has been submitted successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(function () {
              console.log(response);
              $('#userForm')[0].reset();
              // Do something on success
              // Redirect to a different page or do something else
              // after the user clicks "OK"
              $("#Modal-Account").css("display", "none");
            });
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

      $('#userPass').submit(function (e) {
        e.preventDefault();
        $.ajax({
          url: '../PHP/updatePassword.php',
          method: 'POST',
          data: $(this).serialize(),
          success: function (response) {
            Swal.fire({
              title: 'Success!',
              text: 'Your data has been submitted successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(function () {
              console.log(response);
              $('#userPass')[0].reset();
              // Do something on successSS
              // Redirect to a different page or do something else
              // after the user clicks "OK"
            });
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