$(document).ready(function () {
    $(document).on("click", "#join-buttton", function () {
        // get modal
        var modal = $("#join-lomba-modal");

        // close modal
        modal.css("display", "none");

        // get solo-form div
        var soloForm = $("#solo-form");

        // remove solo-form div from form-join-lomba div in modal
        $("#form-join-lomba #solo-form").remove();

        // copy solo-form div to form-join-lomba div in modal
        soloForm.clone().appendTo("#form-join-lomba");

        // set solo-form style in modal to block
        $("#form-join-lomba #solo-form").css("display", "block");

        // get data-lomba
        var lomba = $(this).attr("data-lomba");
        lomba = $.parseJSON(lomba);

        // set modal style to block
        modal.css("display", "block");

        // set modal data
        modal.find("#nama-lomba-modal").html(lomba.nama_lomba);
        modal.find("#lomba-id-input").val(lomba.id);
    });

    $(document).on("click", "#join-lomba-modal #closeButton", function () {
        var modal = $("#join-lomba-modal");
        modal.css("display", "none");
    });
});