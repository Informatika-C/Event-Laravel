document.addEventListener("DOMContentLoaded", function () {
    var showModalLinks = document.querySelectorAll(".show-modal");
    var modalOverlay = document.querySelector(".modal-overlay");

    showModalLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            var modalId = link.getAttribute("data-modal");
            var modal = document.getElementById(modalId);
            modal.style.display = "block";
            modalOverlay.style.display = "block";
        });
    });

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
        modalOverlay.style.display = "none";
    }

    var closeModalButtons = document.querySelectorAll(".modal button");

    closeModalButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var modalId = button.closest(".modal").id;
            closeModal(modalId);
        });
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
