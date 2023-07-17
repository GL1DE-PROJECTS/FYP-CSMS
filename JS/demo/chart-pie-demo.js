// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// // Pie Chart Example

// var myPieChart = new Chart(ctx, {
//   type: 'doughnut',
//   data: {
//     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
//     datasets: [{
//       data: [55, 30, 15],
//       backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
//       hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
//       hoverBorderColor: "rgba(234, 236, 244, 1)",
//     }],
//   },
//   options: {
//     maintainAspectRatio: false,
//     tooltips: {
//       backgroundColor: "rgb(255,255,255)",
//       bodyFontColor: "#858796",
//       borderColor: '#dddfeb',
//       borderWidth: 1,
//       xPadding: 15,
//       yPadding: 15,
//       displayColors: false,
//       caretPadding: 10,
//     },
//     legend: {
//       display: false
//     },
//     cutoutPercentage: 80,
//   },
// });

$(document).ready(function () {
  // Bar Chart Example
  var ctx = document.getElementById("myPieChart");
  $.ajax({
    url: "../PHP/getPrice.php",
    method: "GET",
    success: function (data) {
      // Parse the returned JSON data
      var chartData = JSON.parse(data);
      var barVal = chartData;
      console.log(chartData);
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            data: chartData,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#FF0000', '#00FF00', '#0000FF', '#FFC0CB', '#FF00FF', '#00FFFF', '#800000', '#008000', '#000080'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#800080', '#FFD700', '#808080', '#FF69B4', '#00FF7F', '#DC143C', '#00CED1', '#4B0082', '#FF4500'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#000000",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: true
          },
          cutoutPercentage: 80,
        },
      });
    },
    error: function (xhr, status, error) {
      console.error(error); // Handle any errors
    }
  });
});