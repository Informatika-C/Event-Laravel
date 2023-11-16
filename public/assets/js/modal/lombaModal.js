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
    $(document).on("click", "#kategoriButton", function () {
        var modal = $("#kategoriModal");
        modal.fadeIn();

        $.ajax({
            type: "GET",
            url: "/kategori",
            success: function (response) {
                var kategori = response.kategoris;
                var kategoriList = $("#kategoriList");
                kategoriList.html("");

                // make for loop to make checkbox
                for (var i = 0; i < kategori.length; i++) {
                    var id = kategori[i].id;
                    var nama_kategori = kategori[i].nama_kategori;

                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "kategori[]";
                    checkbox.value = id;
                    checkbox.id = "kategori" + id;
                    checkbox.checked = false;

                    var label = document.createElement("label");
                    label.htmlFor = "kategori" + id;
                    label.appendChild(document.createTextNode(nama_kategori));

                    var br = document.createElement("br");

                    kategoriList.append(checkbox);
                    kategoriList.append(label);
                    kategoriList.append(br);
                }
            },
        });
    });

    $(document).on("click", "#addListKategoriButton", function () {
        var modal = $("#kategoriModal");
        var input = modal.find("#inputListkategori");

        // if input is empty, do nothing
        if (input.val() == "") {
            return;
        }

        $.ajax({
            type: "POST",
            url: "/kategori",
            data: {
                nama_kategori: input.val(),
            },
            success: function (response) {
                // add new checkbox and append to kategoriList
                var kategoriList = $("#kategoriList");

                var id = response.kategori.id;
                var nama_kategori = response.kategori.nama_kategori;

                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "kategori[]";
                checkbox.value = id;
                checkbox.id = "kategori" + id;
                checkbox.checked = false;

                var label = document.createElement("label");
                label.htmlFor = "kategori" + id;
                label.appendChild(document.createTextNode(nama_kategori));

                var br = document.createElement("br");

                kategoriList.append(checkbox);
                kategoriList.append(label);
                kategoriList.append(br);

                // reset input
                input.val("");
            },
            error: function (response) {
                console.log(response);
            }
    });
    });

    $(document).on("click", "#confirmKategori", function () {
        // get kategoriListModal
        var kategoriListModal = $("#kategoriListModal");

        // get kategoriList
        var kategoriList = $("#kategoriList");

        // get all checked value from kategoriList and put it in kategoriListModal
        var kategori = kategoriList.find("input[name='kategori[]']:checked");
        kategoriListModal.html("");
        
        // make for loop to make checkbox
        for (var i = 0; i < kategori.length; i++) {
            var id = kategori[i].value;
            var nama_kategori = kategori[i].nextSibling.textContent;

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "kategori[]";
            checkbox.value = id;
            checkbox.id = "kategori" + id;
            checkbox.checked = true;

            var label = document.createElement("label");
            label.htmlFor = "kategori" + id;
            label.appendChild(document.createTextNode(nama_kategori));

            var br = document.createElement("br");

            kategoriListModal.append(checkbox);
            kategoriListModal.append(label);
            kategoriListModal.append(br);
        }

        // close modal
        var modal = $("#kategoriModal");
        modal.fadeOut();
    });

    $(document).on("click", "#confirmKategoriEdit", function () {
        // get editModal
        var editModal = $("#editModal");

        // get kategoriListModal from editModal
        var kategoriListModal = editModal.find("#kategoriListModal");

        // get kategoriModal
        var kategoriModal = $("#kategoriModalEdit");
        // get kategoriList from kategoriModal
        var kategoriList = kategoriModal.find("#kategoriList");

        // get all checked value from kategoriList and put it in kategoriListModal
        var kategori = kategoriList.find("input[name='kategori[]']:checked");
        kategoriListModal.html("");
        
        // make for loop to make checkbox
        if(kategori.length > 0) {
            for (var i = 0; i < kategori.length; i++) {
                var id = kategori[i].value;
                var nama_kategori = kategori[i].nextSibling.textContent;

                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "kategori[]";
                checkbox.value = id;
                checkbox.id = "kategori" + id;
                checkbox.checked = true;

                var label = document.createElement("label");
                label.htmlFor = "kategori" + id;
                label.appendChild(document.createTextNode(nama_kategori));

                var br = document.createElement("br");

                kategoriListModal.append(checkbox);
                kategoriListModal.append(label);
                kategoriListModal.append(br);
            }
        }
        else {
            // appent integer -1 value to kategoriListModal not array
            var checkbox = document.createElement("input");
            checkbox.type = "number";
            checkbox.name = "kategori";
            checkbox.value = -1;
            checkbox.id = "kategori" + -1;
            checkbox.style.display = "none";

            kategoriListModal.append(checkbox);
        }

        // close modal
        var modal = $("#kategoriModalEdit");
        modal.fadeOut();
    });

    $(document).on("click", "#closeKategoriButton", function () {
        var modal = $("#kategoriModal");
        modal.fadeOut();
    });

    $(document).on("click", "#closeEditKategoriButton", function () {
        var modal = $("#kategoriModalEdit");
        modal.fadeOut();
    });

    $(document).ready(function () {
        $(document).on("click", "#editKategoriButton", function () {
            var modal = $("#kategoriModalEdit");
            modal.fadeIn();

            var parentModal = $("#editModal");

            // get id from parent modal
            var id = parentModal.find("#id").val();

            let arrayOfKategori = [];

            $.ajax({
                type: "GET",
                url: "/kategori/lomba/" + id,
                success: function (res) {
                    console.log(res)
                    // get all id and put it in arrayOfKategori
                    for (var i = 0; i < res.length; i++) {
                        arrayOfKategori.push(res[i].id);
                    }

                    $.ajax({
                        type: "GET",
                        url: "/kategori",
                        success: function (response) {
                            var kategori = response.kategoris;
                            var kategoriList = modal.find("#kategoriList");
                            kategoriList.html("");
            
                            // make for loop to make checkbox and make it checked if id is in arrayOfKategori
                            for (var i = 0; i < kategori.length; i++) {
                                var id = kategori[i].id;
                                var nama_kategori = kategori[i].nama_kategori;
            
                                var checkbox = document.createElement("input");
                                checkbox.type = "checkbox";
                                checkbox.name = "kategori[]";
                                checkbox.value = id;
                                checkbox.id = "kategori" + id;
                                checkbox.checked = false;

                                if(arrayOfKategori.includes(id)) {
                                    checkbox.checked = true;
                                }
            
                                var label = document.createElement("label");
                                label.htmlFor = "kategori" + id;
                                label.appendChild(document.createTextNode(nama_kategori));
            
                                var br = document.createElement("br");
            
                                kategoriList.append(checkbox);
                                kategoriList.append(label);
                                kategoriList.append(br);
                            }
                        },
                    });
                }
            })
    
            
        });
    });

    $(document).on("click", ".deletebtn", function () {
        let id = $(this).data("lomba-id");
        // reset
        $("#del_id").html("");
        $("#del_nama_lomba").html("");

        openDelModal();

        $.ajax({
            type: "GET",
            url: "/dashboard/lomba/show/" + id,
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                console.log("Response from server:", response);

                $("#del_id").html(response.lomba.id);
                $("#del_nama_lomba").html(response.lomba.nama_lomba);

                closeDelModal();
            },
        });

        $("#confirmButton").on("click", function () {
            console.log("Deleting event with ID:", id);
            $.ajax({
                type: "DELETE",
                url: "/dashboard/lomba/destroy/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    $("#del_id").html(response.lomba.id);
                    $("#del_nama_lomba").html(response.lomba.nama_lomba);

                    // reload page
                    location.reload();

                    closeDelModal();
                },
            });

            $("#confirmButton").off("click");
        });
    });
    $(document).on("click", ".editbtn", function () {
        let id = $(this).data("lomba-id");
        openModal();

        // get modal
        let modal = $("#editModal");
        console.log(modal);

        // get #id from modal
        let idModal = modal.find("#id");
        console.log(idModal);

        $.ajax({
            type: "GET",
            url: "/dashboard/lomba/edit/" + id,
            success: function (response) {
                console.log("Response from server:", response);

                idModal.val(response.lomba.id);
                console.log(idModal.val());
                $("#nama_lomba").val(response.lomba.nama_lomba);
                $("#keterangan").val(response.lomba.keterangan);
                $("#ruangan_lomba").val(response.lomba.ruangan_lomba);
                $("#kuota_lomba").val(response.lomba.kuota_lomba);

                const convertedDateTimeString = response.lomba.pelaksanaan_lomba.replace(" ", "T");
                $("#pelaksanaan_lomba").val(convertedDateTimeString);
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

    $(document).on("click", ".upImagebtn", function () {
        var modal = $("#upImageModal");
        modal.fadeIn();

        var id = $(this).val();
        modal.find("#id").val(id);

        // get banner and poster input from this modal
        var bannerInput = modal.find("#banner");
        var posterInput = modal.find("#poster");

        // get loader class from this modal
        var loader = modal.find(".loader");
        // unhide loader
        loader.show();

        // reset input
        bannerInput.val("");
        posterInput.val("");

        var posterContainer = document.getElementById("poster-container");
        posterContainer.style.display = "none";

        getImage(id, posterContainer, loader);
    });

    function getImage(id, posterContainer, loader) {
        $.ajax({
            type: "GET",
            url: "/dashboard/lomba/show/" + id,
            success: function (response) {
                loader.hide();
                if(response.lomba.poster == null) {
                    posterContainer.style.display = "block";
                    posterContainer.src = "/assets/images/blank.jpg";
                    posterContainer.alt = "Blank Image";
                    posterContainer.style.width = "10em";

                    return;
                }
                posterContainer.style.display = "block";
                posterContainer.src =
                    "/storage/lomba/poster/" + id + "/" + response.lomba.poster;
                posterContainer.alt = "Poster Lomba";
                posterContainer.style.width = "10em";
            },
        });
    }
});
