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
    console.log("Opening modal for lomba ID:", id);

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
        var id = $(this).data("lomba-id");
        openDelModal();

        $.ajax({
            type: "GET",
            url: "/dashboard/lomba/show/" + id,
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                console.log("Response from server:", response);

                $("#id").val(response.lomba.id);
                $("#nama_lomba").val(response.lomba.nama_lomba);
                $("#keterangan").val(response.lomba.keterangan);
                $("#ruangan_lomba").val(response.lomba.ruangan_lomba);
                $("#kuota_lomba").val(response.lomba.kuota_lomba);

                var formattedDate = new Date(response.lomba.pelaksanaan_lomba)
                    .toISOString()
                    .slice(0, 16);
                $("#pelaksanaan_lomba").val(formattedDate);

                closeDelModal();
            },
        });

        $("#confirmButton").on("click", function () {
            $.ajax({
                type: "DELETE",
                url: "/dashboard/lomba/destroy/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    console.log("Response from server:", response);

                    // Sesuaikan dengan nama input pada form edit Lomba
                    $("#id").val(response.lomba.id);
                    $("#nama_lomba").val(response.lomba.nama_lomba);
                    $("#keterangan").val(response.lomba.keterangan);
                    $("#ruangan_lomba").val(response.lomba.ruangan_lomba);
                    $("#kuota_lomba").val(response.lomba.kuota_lomba);

                    var formattedDate = new Date(
                        response.lomba.pelaksanaan_lomba
                    )
                        .toISOString()
                        .slice(0, 16);
                    $("#pelaksanaan_lomba").val(formattedDate);

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
            url: "/dashboard/lomba/edit/" + id,
            success: function (response) {
                console.log("Response from server:", response);

                $("#id").val(response.lomba.id);
                $("#nama_lomba").val(response.lomba.nama_lomba);
                $("#keterangan").val(response.lomba.keterangan_lomba);
                $("#ruangan_lomba").val(response.lomba.ruangan_lomba);
                $("#kuota_lomba").val(response.lomba.kuota_lomba);

                var formattedDate = new Date(response.lomba.pelaksanaan_lomba)
                    .toISOString()
                    .slice(0, 16);
                $("#pelaksanaan_lomba").val(formattedDate);
            },
        });
    });

    $(document).on("click", ".openInfoModalBtn", function () {
        var id = $(this).data("lomba-id");
        openInfoModal(id);

        $.ajax({
            type: "GET",
            url: "/dashboard/lomba/show/" + id,
            success: function (response) {
                console.log("Response from server:", response);

                $("#id").val(response.lomba.id);
                $("#nama_lomba").val(response.lomba.nama_lomba);
                $("#keterangan").val(response.lomba.keterangan);
                $("#ruangan_lomba").val(response.lomba.ruangan_lomba);
                $("#kuota_lomba").val(response.lomba.kuota_lomba);

                var formattedDate = new Date(response.lomba.pelaksanaan_lomba)
                    .toISOString()
                    .slice(0, 16);
                $("#pelaksanaan_lomba").val(formattedDate);
            },
        });
    });
});
