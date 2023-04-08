

$(document).ready(function () {
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
});