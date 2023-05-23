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
            window.location.href = '../html/index.html';
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