// TEXT
AOS.init({});
gsap.to(".lead", { duration: 2, delay: 4.5, text: "<b>JOIN</b> WITH US" });
gsap.from(".display-4", {
    duration: 2,
    x: 1.5,
    opacity: 0.02,
    delay: 1.2,
    ease: "back",
});
gsap.registerPlugin(TextPlugin);

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
        gsap.to(element, { duration: 2, text: text });
    });
}

window.addEventListener("scroll", () => {
    const contentRect = contentElement.getBoundingClientRect();

    if (contentRect.top <= window.innerHeight && contentRect.bottom >= 0) {
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
    iconContainer.style.display = "flex";
}

function hideIconContainer() {
    iconContainer.style.display = "none";
}

window.addEventListener("scroll", () => {
    const contentRect = contentEl.getBoundingClientRect();
    if (contentRect.top <= window.innerHeight && contentRect.bottom >= 0) {
        showIconContainer();
    } else {
        hideIconContainer();
    }
});

// CARROUSEL
let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("carousel-item");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 3000);
}
