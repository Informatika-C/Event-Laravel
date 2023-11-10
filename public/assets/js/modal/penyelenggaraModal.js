function openModal() {
    $("#editModal").fadeIn();
}

function openDelModal() {
    $("#deleteModal").fadeIn();
}

function closeDelModal() {
    $("#editModal").fadeOut();
}

function closeModal() {
    $("#editModal").fadeOut();
}

function openInfoModal(id) {
    $("#infoModal").fadeIn();
    console.log("Opening modal for Penyelenggara ID:", id);

    $(document).on("click", outsideModalClick);
}

function outsideModalClick(e) {
    if (!$(e.target).closest(".tr-modal-content").length) {
        closeInfoModal();
    }
}

function closeInfoModal() {
    $("#infoModal").fadeOut();
    clearConsole();
    $(document).off("click", outsideModalClick);
}

function clearConsole() {
    if (window.console && window.console.clear) {
        console.clear();
    }
}

$(document).ready(function () {
    $(document).on("click", ".deletebtn", function () {
        var id = $(this).attr("del-id");

        openDelModal();

        $.ajax({
            type: "GET",
            url: "/dashboard/penyelenggara/show/" + id,
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                console.log("Response from server:", response);
                $("#del_id").html(response.penyelenggara.id);
                $("#del_nama_penyelenggara").html(
                    response.penyelenggara.nama_penyelenggara
                );

                closeDelModal();
            },
        });

        $("#confirmButton").on("click", function () {
            $.ajax({
                type: "DELETE",
                url: "/dashboard/penyelenggara/destroy/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    console.log("Response from server:", response);
                    $("#del_id").html(response.penyelenggara.id);
                    $("#del_nama_penyelenggara").html(
                        response.penyelenggara.nama_penyelenggara
                    );

                    closeDelModal();
                },
            });

            $("#confirmButton").off("click");
        });
    });
    $(document).on("click", ".editbtn", function () {
        var id = $(this).val();
        openModal();

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

    $(document).on("click", ".openInfoModalBtn", function () {
        var id = $(this).data("penyelenggara-id");
        openInfoModal(id);

        $.ajax({
            type: "GET",
            url: "/dashboard/penyelenggara/show/" + id,
            success: function (response) {
                console.log("Response from server:", response);
                $("#info_id").html(response.penyelenggara.id);
                $("#info_nama_penyelenggara").html(
                    response.penyelenggara.nama_penyelenggara
                );
                $("#info_no_telp").html(response.penyelenggara.no_telp);
            },
        });
    });
});
