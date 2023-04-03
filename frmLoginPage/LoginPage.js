$(document).ready(function () {
    
    //#region Modal Create Account
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

    //#region Modal Forgot Password
    $("#btnFgtPwd").click(function () {
        $("#Modal-ForgotPwd").css("display", "block");
    });

    $(".close").click(function () {
        $("#Modal-ForgotPwd").css("display", "none");
    });

    $(window).click(function (event) {
        if (event.target == document.getElementById("myModal")) {
            $("#Modal-ForgotPwd").css("display", "none");
        }
    });
    //#endregion
});

function toMainPage() {
    window.location.href = "../frmMainPage/frmMainPage.html";
    return false;
}
