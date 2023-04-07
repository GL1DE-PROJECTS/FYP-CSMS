// var hamburger = document.querySelector(".hamburger");
// hamburger.addEventListener("click", function () {
//     document.querySelector("body").classList.toggle("active");
// })


$(document).ready(function () {

    $(".hamburger").on("click", function () {
        $("body").toggleClass("active");
    });

});