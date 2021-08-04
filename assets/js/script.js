$(document).ready(() => {
    let showMini = false;

    $("#user-profile").click((event) => {
        showMini = !showMini;

        if (showMini) {
            $("#mini-menu").css("display", "block");
        }
        else {
            $("#mini-menu").css("display", "none");
        }
    });

    // Arsip baru
    $("#sistem_simpan").on('change', (event)=> {
        $("#kode_simpan").prop("disabled", false);
    });

    $("#reset-btn").click((event) => {
        $.each($(".input-data:not(:disabled)"), (idx, value) => {
            event.preventDefault();
            $(value).val(null);
        });
    });
});