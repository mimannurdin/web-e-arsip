$(document).ready(() => {
    let menuOpen = true;
    $("#hamburger").click((event) => {
        menuOpen = !menuOpen;

        if (menuOpen) {
            $("#main-container").css("grid-template-columns", "260px auto");
            $("#logo-container").css("transform", "scale(0)");
        } else {
            $("#main-container").css("grid-template-columns", "0 auto");
            $("#logo-container").css("transform", "scale(1)");
        }
    });
});