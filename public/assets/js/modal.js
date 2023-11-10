$(document).ready(function () {
    $(".show-modal").on("click", function () {
        var modalId = $(this).data("modal");
        $("#" + modalId).show();
        console.log("Open Add Modal, please input data!", modalId);
    });

    $("#closeButton, #closeModal").on("click", function () {
        $(".modal").hide();
        $("input[required], textarea[required]").removeAttr("required");
        console.log("Modal Is Closed!");

        console.clear();
    });
});
