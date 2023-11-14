$(document).ready(function () {
    $(".show-modal").on("click", function () {
        var modalId = $(this).data("modal");
        var eventId = $(this).data("event-id"); // Mengambil 'event_id' dari atribut data-event-id
        $("#" + modalId)
            .find("#event_id")
            .val(eventId); // Mengisi nilai 'event_id' ke input tersembunyi

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
