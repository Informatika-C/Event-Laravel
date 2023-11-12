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
    console.log("Opening modal for event ID:", id);

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
        // reset
        $("#del_id").html("");
        $("#del_nama_lomba").html("");

        var id = $(this).attr("del-id");

        openDelModal();

        $.ajax({
            type: "GET",
            url: "/dashboard/events/show/" + id,
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                console.log("Response from server:", response);
                $("#del_id").html(response.event.id);
                $("#del_nama_lomba").html(response.event.nama_lomba);

                closeDelModal();
            },
        });
        $("#confirmButton").on("click", function () {
            console.log("Deleting event with ID:", id);
            $.ajax({
                type: "DELETE",
                url: "/dashboard/events/destroy/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    console.log("Response from server:", response);
                    $("#del_id").html(response.event.id);
                    $("#del_nama_lomba").html(response.event.nama_lomba);

                    // reload page
                    location.reload();

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
            url: "/dashboard/events/edit/" + id,
            dataType: "json",
            success: function (response) {
                console.log("Response from server:", response);

                $("#id").val(response.event.id);
                $("#nama_lomba").val(response.event.nama_lomba);
                $("#deskripsi").val(response.event.deskripsi);
                $("#tempat").val(response.event.tempat);
                $("#kuota").val(response.event.kuota);
                $("#tanggal_pendaftaran").val(
                    response.event.tanggal_pendaftaran
                );
                $("#tanggal_penutupan_pendaftaran").val(
                    response.event.tanggal_penutupan_pendaftaran
                );
                $("#tanggal_pelaksanaan").val(
                    response.event.tanggal_pelaksanaan
                );

                // get this modal element
                var modal = document.getElementById("editModal");
                console.log("Modal:", modal);

                // get penyelenggara_id element from this modal
                var penyelenggaraDropdown = modal.querySelector(
                    "#penyelenggara_id"
                );

                var id = modal.querySelector("#id");

                id.value = response.event.id;

                if (!penyelenggaraDropdown) {
                    console.error(
                        "Element with ID 'penyelenggara_id' not found."
                    );
                    return;
                }

                penyelenggaraDropdown.innerHTML = "";

                if (Array.isArray(response.penyelenggaras)) {
                    response.penyelenggaras.forEach(function (penyelenggara) {
                        var option = document.createElement("option");
                        option.value = penyelenggara.id;
                        option.text =
                            penyelenggara.id +
                            " - " +
                            penyelenggara.nama_penyelenggara;

                        if (
                            penyelenggara.id == response.event.penyelenggara_id
                        ) {
                            option.selected = true;
                        }

                        penyelenggaraDropdown.appendChild(option);
                    });
                } else {
                    console.error(
                        "Data penyelenggaras is not an array:",
                        response.penyelenggaras
                    );
                }
            },
            error: function (error) {
                console.error("Error fetching data:", error);
            },
        });
    });

    $(document).on("click", ".openInfoModalBtn", function () {
        var id = $(this).data("event-id");
        openInfoModal(id);

        $.ajax({
            type: "GET",
            url: "/dashboard/events/show/" + id,
            success: function (response) {
                console.log("Response from server:", response);
                $("#id").html(response.event.id);
                $("#info_nama_lomba").html(response.event.nama_lomba);
                $("#info_deskripsi").html(response.event.deskripsi);
                $("#info_tempat").html(response.event.tempat);
                $("#info_kuota").html(response.event.kuota);
                $("#info_tanggal_pendaftaran").html(
                    response.event.tanggal_pendaftaran
                );
                $("#info_tanggal_penutupan_pendaftaran").html(
                    response.event.tanggal_penutupan_pendaftaran
                );
                $("#info_tanggal_pelaksanaan").html(
                    response.event.tanggal_pelaksanaan
                );
                $("#info_penyelenggara_id").html(
                    response.event.penyelenggara_id
                );
            },
        });
    });
});
