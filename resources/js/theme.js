if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}
$(function () {
    setTimeout(function () {
        $(".page-loader-wrapper").fadeOut();
    }, 50);

    $("#toggleLeftSideBar").change(function () {
        if (this.checked) {
            $("#navbarSupportedContent").removeClass("yes");
            $("#navbarSupportedContent").addClass("no");
        } else {
            $("#navbarSupportedContent").removeClass("no");
            $("#navbarSupportedContent").addClass("yes");
        }
    });

    $(window).resize(function () {
        var width = $(window).width();
        if (width >= 768) {
            $("#navbarSupportedContent").removeClass("no");
            $("#navbarSupportedContent").removeClass("yes");
        } else if (width < 768) {
            if ($("#toggleLeftSideBar").is(":checked")) {
                $("#navbarSupportedContent").removeClass("yes");
                $("#navbarSupportedContent").addClass("no");
            } else {
                $("#navbarSupportedContent").removeClass("no");
                // $("#navbarSupportedContent").addClass("yes");
            }
        }
    });
});
