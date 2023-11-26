// CARROUSEL
let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("carousel-item");

    // Periksa apakah slides ada atau tidak
    if (!slides || slides.length === 0) {
        return; // Hentikan eksekusi jika tidak ada elemen
    }

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Pastikan slideIndex tidak melebihi jumlah slides
    slideIndex = slideIndex >= slides.length ? 0 : slideIndex;

    slides[slideIndex].style.display = "block";
    slideIndex++;

    setTimeout(showSlides, 3000);
}

// TEXT
AOS.init({});

// Wrap GSAP code in a function to ensure DOM is ready
function initGSAP() {
    // Check if the target element exists
    const leadElement = document.querySelector(".lead");
    if (!leadElement) {
        return;
    }

    gsap.to(leadElement, {
        duration: 2,
        delay: 4.5,
        text: "<b>JOIN</b> WITH US",
    });
    // gsap.from(".display-4", {
    //     duration: 2,
    //     x: 1.5,
    //     opacity: 0.02,
    //     delay: 1.2,
    //     ease: "back",
    // });
    gsap.registerPlugin(TextPlugin);
}

// Call the initGSAP function when the DOM is ready
document.addEventListener("DOMContentLoaded", initGSAP);

// Rest of your code...

const typElements = document.querySelectorAll(".typ");
const contentElement = document.querySelector(".about-section");

const textOptions = [
    "Become a Winner",
    "Discover New Possibilities",
    "Unlock Your Potential",
];

let typTextChanged = false;

function changeTypText(text) {
    typTextChanged = true;
    typElements.forEach((element) => {
        if (element) {
            gsap.to(element, { duration: 2, text: text });
        }
    });
}

window.addEventListener("scroll", () => {
    const contentRect = contentElement
        ? contentElement.getBoundingClientRect()
        : null;

    if (
        contentRect &&
        contentRect.top <= window.innerHeight &&
        contentRect.bottom >= 0
    ) {
        if (!typTextChanged) {
            const randomText =
                textOptions[Math.floor(Math.random() * textOptions.length)];
            changeTypText(randomText);
        }
    }
});

const iconContainer = document.querySelector(".icon-container");
const contentEl = document.querySelector(".content");

function showIconContainer() {
    if (iconContainer) {
        iconContainer.style.display = "flex";
    }
}

function hideIconContainer() {
    if (iconContainer) {
        iconContainer.style.display = "none";
    }
}

window.addEventListener("scroll", () => {
    const contentRect = contentEl ? contentEl.getBoundingClientRect() : null;
    if (
        contentRect &&
        contentRect.top <= window.innerHeight &&
        contentRect.bottom >= 0
    ) {
        showIconContainer();
    } else {
        hideIconContainer();
    }
});
