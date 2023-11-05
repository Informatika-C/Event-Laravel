const notification = document.getElementById("notification");
const notifyContainer = document.querySelector(".notify-container");

function hasSeenNotification() {
    return sessionStorage.getItem("seenNotification") === "true";
}

function showNotification() {
    if (!hasSeenNotification()) {
        notification.style.display = "block";
        notification.style.animation = "show 1s ease forwards";

        setTimeout(() => {
            showNotifyContainer();
        }, 3000);
    }
    // setTimeout(() => {
    //     hideNotification();
    // }, 6000);
}

function showNotifyContainer() {
    if (hasSeenNotification()) {
        return;
    }
    if (notifyContainer) {
        notifyContainer.style.display = "block";
        notifyContainer.style.animation = "show 1s ease forwards";
        setTimeout(() => {
            hideNotification();
        }, 6000);
    }
}

function hideNotification() {
    notification.style.animation = "dissolve 1s ease forwards";

    setTimeout(() => {
        notification.style.display = "none";
        notification.style.animation = "";
    }, 1500);
}

function closeNotification() {
    notification.style.animation = "dissolve 1s ease forwards";

    if (notifyContainer) {
        notifyContainer.style.animation = "dissolve 1s ease forwards";
    }

    setTimeout(() => {
        notification.style.display = "none";
        notification.style.animation = "";

        if (notifyContainer) {
            notifyContainer.style.display = "none";
            notifyContainer.style.animation = "";
        }

        if (!hasSeenNotification()) {
            sessionStorage.setItem("seenNotification", "true");
        }
    }, 1500);
}

function resetSeenNotification() {
    sessionStorage.setItem("seenNotification", "false");
}

showNotification();
