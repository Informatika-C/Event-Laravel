function showTab(tabId) {
    const tabButtons = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach((button) => {
        button.classList.remove("active");
    });

    tabContents.forEach((content) => {
        content.classList.remove("active");
    });

    document.getElementById(tabId).classList.add("active");
    document.getElementById(`content-${tabId}`).classList.add("active");
}
