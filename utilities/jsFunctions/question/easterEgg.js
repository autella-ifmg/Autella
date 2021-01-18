function easterEgg() {
    var easter_egg = 1;

    $.ajax({
        type: "POST",
        url: "updateSQL.php",
        data: {
            easter_egg
        },
        success: function (message) {
            $("#img_toast").attr({
                src: "../../../libraries/bootstrap/bootstrap-icons-1.0.0/egg-fill.svg",
                alt: "Easter egg"
            });
            $("#span_toast").text("Easter egg");
            $("#result").html(message).fadeIn();
            $("#toast").toast("show");
            setTimeout(3000);
            //console.log(message);
        }
    });
}