$(document).ready(function () {
    $(document).on("click", "#join-buttton", function () {
        // get data-lomba
        var lomba = $(this).attr("data-lomba");
        lomba = $.parseJSON(lomba);

        // get modal
        var modal = $("#join-lomba-modal");

        // close modal
        modal.css("display", "none");

        // get solo-form div
        var soloForm = $("#solo-form");

        // get group-form div
        var grupForm = $("#grup-form");

        // remove inside #form-join-lomba div
        $("#form-join-lomba").empty();

        if (lomba.max_anggota == 1) {
            // copy solo-form div to form-join-lomba div in modal
            soloForm.clone().appendTo("#form-join-lomba");

            // set solo-form style in modal to block
            $("#form-join-lomba #solo-form").css("display", "block");
        }
        else {
            // copy group-form div to form-join-lomba div in modal
            grupForm.clone().appendTo("#form-join-lomba");

            // set group-form style in modal to block
            $("#form-join-lomba #grup-form").css("display", "block");

            // remove anggota-grup div inside grup-form div
            $("#form-join-lomba #grup-form #anggota-grup").empty();

            // make selectbox and label as many as max_anggota and append to anggota-grup div but on the first input set as ketua
            for (var i = 0; i < lomba.max_anggota; i++) {
                if(i==0){
                    var label = $("<label></label>").attr("for", "anggota-" + i).html("Anggota 1 / Ketua");
                }
                else{
                    var label = $("<label></label>").attr("for", "anggota-" + i).html("Anggota " + (i + 1));
                }
                var selectBox = $("<select></select>").attr("id", "anggota-" + i).attr("name", "anggota[]").addClass("form-control");

                selectBox.attr("required", "required");
                
                // add name class "search" to selectbox
                selectBox.addClass("search-select");

                // append label and selectbox to anggota-grup div
                $("#form-join-lomba #grup-form #anggota-grup").append(label).append(selectBox);
            }
        }

        var selectBox = modal.find(".search-select");

        // set select2
        selectBox.select2({
            placeholder: 'Select User',
            ajax: {
                url: '/ajax-autocomplete-contestant',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true,
            }
        });

        // set modal style to block
        modal.css("display", "block");

        // set modal data
        modal.find("#nama-lomba-modal").html(lomba.nama_lomba);
        modal.find("#lomba-id-input").val(lomba.id);
    });

    $(document).on("click", "#out-buttton", function () {
        var modal = $("#out-lomba-modal");
        modal.css("display", "none");

        // get data-lomba
        var lomba = $(this).attr("data-lomba");
        lomba = $.parseJSON(lomba);

        // set Modal Title to "Keluar Lomba"
        modal.find("#modal-title").html("Keluar " + lomba.nama_lomba);

        modal.find("#lomba-id-input").val(lomba.id);

        modal.css("display", "block");
    });

    $(document).on("click", "#out-lomba-modal #closeButton", function () {
        var modal = $("#out-lomba-modal");
        modal.css("display", "none");
    });

    $(document).on("click", "#join-lomba-modal #closeButton", function () {
        var modal = $("#join-lomba-modal");
        modal.css("display", "none");
    });
});