$(document).ready(function () {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});



function updateStatus(button) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will approve this user!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, approve',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const row = button.parentNode.parentNode;
            const ID = row.cells[0].innerHTML; // Get the name value from the first cell

            // Send an AJAX request to the server-side PHP script
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // If the deletion is successful, remove the row from the table
                    if (this.responseText === "success") {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your data has been updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                          }).then(function () {
                            console.log(this.responseText)
                            location.reload();
                          });
                    } else {
                        console.log(this.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error updating your data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            };
            xhttp.open("GET", "../PHP/updateStatus.php?id=" + encodeURIComponent(ID), true);
            xhttp.send();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'The deletion has been cancelled.', 'error');
        }
    });
}


function deleteRow(button) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this row!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const row = button.parentNode.parentNode;
            const ID = row.cells[0].innerHTML; // Get the name value from the first cell

            // Send an AJAX request to the server-side PHP script
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // If the deletion is successful, remove the row from the table
                    if (this.responseText === "success") {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your data has been deleted successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                          }).then(function () {
                            console.log(this.responseText)
                            location.reload();
                          });
                    } else {
                        console.log(this.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error deleting your data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            };
            xhttp.open("GET", "../PHP/deleteUser.php?id=" + encodeURIComponent(ID), true);
            xhttp.send();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'The deletion has been cancelled.', 'error');
        }
    });
}