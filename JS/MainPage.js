// var hamburger = document.querySelector(".hamburger");
// hamburger.addEventListener("click", function () {
//     document.querySelector("body").classList.toggle("active");
// })


$(document).ready(function () {

    $(window).resize(function () {
        var windowHeight = $(window).height();
        var windowWidth = $(window).width();

        // Set the height and width of the element based on the window size
        $('body').css('height', windowHeight);
        $('body').css('width', windowWidth);
    });

    $(".hamburger").on("click", function () {
        $("body").toggleClass("active");
    });

    $("#myBtn").click(function () {
        $("#Modal-UserSettings").css("display", "block");
    });

    $(".close").click(function () {
        $("#Modal-UserSettings").css("display", "none");
    });

    $(window).click(function (event) {
        if (event.target == document.getElementById("myModal")) {
            $("#Modal-Account").css("display", "none");
        }
    });
});