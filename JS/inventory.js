$(document).ready(function () {
    $('#myTable').DataTable();


    $.ajax({
        url: '/PHP/getInventory.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Initialize DataTable with fetched data
            var table = $('#myTable').DataTable({
                data: data,
                columns: [
                    { data: 'ID' },
                    { data: 'Make' },
                    { data: 'Model' },
                    { data: 'Year' },
                    { data: 'Price' },
                    { data: 'Color' },
                    { data: 'Mileage' },
                    { data: 'Condition' },
                    { data: 'Location' },
                    { data: 'Status' }
                ]
            });
        }
    });
});

$("#myTable").DataTable({
    scrollY: 400
});