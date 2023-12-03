const prevBtn = document.querySelector("div.prev-arrow");
const nextBtn = document.querySelector("div.next-arrow");
const sectionContainer = document.querySelector("div.carousel-sections");

prevBtn.onclick = () => prev(1000);
nextBtn.onclick = () => next(1000);

let currentIndex = 0;
let slides = [];
let dots = [];
let autoScrollInterval;

function render() {
    let offset = 0;
    slides.forEach((slide, index) => {
        if (index < currentIndex) {
            offset += slide.offsetWidth;
        }
    });

    animateTransition(offset);
}

function animateTransition(offset) {
    const transitionDuration = 1000;
    sectionContainer.style.transition = `transform ${transitionDuration}ms ease`;
    sectionContainer.style.transform = `translateX(-${offset}px)`;

    setTimeout(() => {
        sectionContainer.style.transition = "";
    }, transitionDuration);

    dots.forEach((dot, index) => {
        index === currentIndex
            ? dot.classList.add("active")
            : dot.classList.remove("active");
    });
}

function prev(delay) {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    render();
    setTimeout(() => render(), delay);
}

function next(delay) {
    currentIndex = (currentIndex + 1) % slides.length;
    render();
    setTimeout(() => render(), delay);
}

function goto(newIndex) {
    currentIndex = newIndex;
    render();
}

function startAutoScroll() {
    autoScrollInterval = setInterval(() => {
        next(1000);
    }, 8000);
}

function stopAutoScroll() {
    clearInterval(autoScrollInterval);
}

function init() {
    const newSlides = document.querySelectorAll("div.carousel-sections > div");
    slides = newSlides;

    const newDots = document.querySelectorAll("div.carousel-dots > div");
    newDots.forEach((dot, index) => {
        dot.onclick = () => goto(index);
    });
    dots = newDots;

    render();

    startAutoScroll();

    // sectionContainer.addEventListener("mouseenter", stopAutoScroll);
    // sectionContainer.addEventListener("mouseleave", startAutoScroll);
}

init();
