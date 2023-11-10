$(document).ready(function () {
    $(".show-modal").on("click", function () {
        var modalId = $(this).data("modal");
        $("#" + modalId).show();
        console.log("Open Add Modal, please input data!", modalId);

        $.ajax({
            type: "GET",
            url: "/dashboard/penyelenggara/edit/" + id,
            success: function (response) {
                console.log("Response from server:", response);
                $("#id").val(response.penyelenggara.id);
                $("#nama_penyelenggara").val(
                    response.penyelenggara.nama_penyelenggara
                );
                $("#no_telp").val(response.penyelenggara.no_telp);
            },
        });
    });

    $("#closeButton, #closeModal").on("click", function () {
        $(".modal").hide();
        $("input[required], textarea[required]").removeAttr("required");
        console.log("Modal Is Closed!");

        console.clear();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var showTrModals = document.querySelectorAll(".show-tr-modal");
    showTrModals.forEach(function (row) {
        row.addEventListener("click", function () {
            var trModalId = row.getAttribute("data-tr-modal");
            var trModal = document.getElementById(trModalId);
            if (trModal) {
                trModal.style.display = "block";

                window.addEventListener("click", function (event) {
                    if (event.target === trModal) {
                        trModal.style.display = "none";
                    }
                });
            }
        });
    });
});
