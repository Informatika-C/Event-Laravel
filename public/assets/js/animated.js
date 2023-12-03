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
        delay: 3.5,
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

const typElements = document.querySelectorAll(".typ");
const textOptions = [
    "Become a Winner",
    "Discover New Possibilities",
    "Unlock Your Potential",
];

let typTextChanged = false;

const observer = new IntersectionObserver(
    (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting && !typTextChanged) {
                typTextChanged = true;
                changeTypText();
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.5 }
);

// Merekam setiap elemen yang akan diawasi
typElements.forEach((element) => observer.observe(element));

function changeTypText() {
    const shuffledTextOptions = [...textOptions].sort(
        () => Math.random() - 0.5
    );
    typElements.forEach((element, index) => {
        if (element) {
            gsap.to(element, {
                duration: 2,
                delay: 2,
                text: shuffledTextOptions[index],
                opacity: 1,
            });
        }
    });
}
// const typElements = document.querySelectorAll(".typ");
// const contentElement = document.querySelector(".coundown-section");

// const textOptions = [
//     "Become a Winner",
//     "Discover New Possibilities",
//     "Unlock Your Potential",
// ];

// let typTextChanged = false;

// function changeTypText() {
//     typTextChanged = true;

//     // Mengacak urutan array textOptions
//     const shuffledTextOptions = [...textOptions].sort(
//         () => Math.random() - 0.5
//     );

//     typElements.forEach((element, index) => {
//         if (element) {
//             gsap.to(element, { duration: 2, text: shuffledTextOptions[index] });
//         }
//     });
// }

// changeTypText();

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
