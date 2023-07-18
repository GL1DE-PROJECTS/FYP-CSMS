$(document).ready(function () {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    $('#newSales').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '../PHP/insert_sales.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if(response = "success 3")
                {
                    console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your data has been submitted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function () {
                        $('#newSales')[0].reset();
                        // Do something on success
                        // Redirect to a different page or do something else
                        // after the user clicks "OK"
                        $("#Modal-Account").css("display", "none");
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

    $('#product_id').on('change', function() {
        var selectedIndex = $(this).val();
        if (selectedIndex) {
          $.ajax({
            url: '../PHP/getRegistration.php',
            method: 'POST',
            data: { selectedIndex: selectedIndex },
            success: function(response) {
              $('#registration').val(response);
            },
            error: function() {
              console.log('Error occurred while fetching file.');
            }
          });
        }
      });
});



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
                    if (this.responseText === "successsuccesssuccess") {
                        console.log(this.responseText);
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
            xhttp.open("GET", "../PHP/delSales.php?id=" + encodeURIComponent(ID), true);
            xhttp.send();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'The deletion has been cancelled.', 'error');
        }
    });
}

function exportDataTableToPDF(dataTableId) {
    const doc = new jsPDF();
  
    // Fetch the DataTable element
    const dataTable = document.getElementById(dataTableId);
  
    // Get the table's HTML content
    const tableHTML = dataTable.outerHTML;
  
    // Convert HTML to PDF
    doc.fromHTML(tableHTML, 15, 15, { 'width': 180 });
  
    // Save the PDF
    doc.save('datatable.pdf');
  
  }