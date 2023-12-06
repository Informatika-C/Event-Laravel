const toggleNavbarBtn = document.getElementById("toggleNavbar");
const navbarOverlay = document.getElementById("navbarOverlay");

function openNavbar() {
    navbarOverlay.style.display = "block";
}

function closeNavbar() {
    navbarOverlay.style.display = "none";
}

function isNavbarOpen() {
    return navbarOverlay.style.display === "block";
}

toggleNavbarBtn.addEventListener("click", function () {
    if (isNavbarOpen()) {
        closeNavbar();
    } else {
        openNavbar();
    }
});

const darkModeToggle = document.getElementById("darkModeToggle");
const body = document.body;
let vantaInstance = null;

function toggleDarkMode(isDark) {
    body.classList.toggle("dark-mode", isDark);
    darkModeToggle.checked = isDark;
    localStorage.setItem("mode", isDark ? "dark" : "light");
}

darkModeToggle.addEventListener("change", () =>
    toggleDarkMode(darkModeToggle.checked)
);

const userPreference = localStorage.getItem("mode");
if (userPreference === "dark") {
    toggleDarkMode(true);
}

var SCREEN_WIDTH = window.innerWidth;
var SCREEN_HEIGHT = window.innerHeight;

var RADIUS = 90;

var RADIUS_SCALE = 1;
var RADIUS_SCALE_MIN = 1;
var RADIUS_SCALE_MAX = 1;

var QUANTITY = 30;

var canvas;
var context;
var particles;

var mouseX = SCREEN_WIDTH * 0.5;
var mouseY = SCREEN_HEIGHT * 0.5;
var mouseIsDown = false;
let isDarkMode = false;

function init() {
    canvas = document.getElementById("world");

    if (canvas && canvas.getContext) {
        context = canvas.getContext("2d");

        // register event listeners
        window.addEventListener("pointerdown", documentInputDownHandler, false);
        window.addEventListener("pointermove", documentInputMoveHandler, false);
        window.addEventListener("pointerup", documentInputUpHandler, false);

        window.addEventListener("resize", windowResizeHandler, false);

        createParticles();

        windowResizeHandler();

        setInterval(loop, 1000 / 60);
    }

    darkModeToggle.addEventListener("change", (event) => {
        isDarkMode = event.target.checked;
    });

    const userPreference = localStorage.getItem("mode");
    if (userPreference === "dark") {
        darkModeToggle.checked = true;
        isDarkMode = true;
    }
}

function createParticles() {
    particles = [];

    for (var i = 0; i < QUANTITY; i++) {
        var particle = {
            size: 1,
            position: { x: mouseX, y: mouseY },
            offset: { x: 0, y: 0 },
            shift: { x: mouseX, y: mouseY },
            speed: 0.01 + Math.random() * 0.04,
            targetSize: 1,
            fillColor:
                "#" + ((Math.random() * 0x404040 + 0xaaaaaa) | 0).toString(18),
            orbit: RADIUS * 0.5 + RADIUS * 0.5 * Math.random(),
        };

        particles.push(particle);
    }
}

function documentInputDownHandler(event) {
    if (event.touches) {
        mouseX =
            event.touches[0].clientX - (window.innerWidth - SCREEN_WIDTH) * 0.5;
        mouseY =
            event.touches[0].clientY -
            (window.innerHeight - SCREEN_HEIGHT) * 0.5;
    } else {
        mouseX = event.clientX - (window.innerWidth - SCREEN_WIDTH) * 0.5;
        mouseY = event.clientY - (window.innerHeight - SCREEN_HEIGHT) * 0.5;
    }

    mouseIsDown = true;
    event.preventDefault();
}

function documentInputMoveHandler(event) {
    if (event.touches) {
        mouseX =
            event.touches[0].clientX - (window.innerWidth - SCREEN_WIDTH) * 0.5;
        mouseY =
            event.touches[0].clientY -
            (window.innerHeight - SCREEN_HEIGHT) * 0.5;
    } else {
        mouseX = event.clientX - (window.innerWidth - SCREEN_WIDTH) * 0.5;
        mouseY = event.clientY - (window.innerHeight - SCREEN_HEIGHT) * 0.5;
    }

    event.preventDefault();
}

function documentInputUpHandler(event) {
    mouseIsDown = false;
    event.preventDefault();
}

function windowResizeHandler() {
    SCREEN_WIDTH = window.innerWidth;
    SCREEN_HEIGHT = window.innerHeight;

    canvas.width = SCREEN_WIDTH;
    canvas.height = SCREEN_HEIGHT;
}

function loop() {
    if (mouseIsDown) {
        RADIUS_SCALE += (RADIUS_SCALE_MAX - RADIUS_SCALE) * 0.02;
    } else {
        RADIUS_SCALE -= (RADIUS_SCALE - RADIUS_SCALE_MIN) * 0.02;
    }

    RADIUS_SCALE = Math.min(RADIUS_SCALE, RADIUS_SCALE_MAX);

    if (isDarkMode) {
        context.fillStyle = "rgba(225, 220, 209, 0.5)";
    } else {
        context.fillStyle = "rgba(6, 20, 46, 0.5)";
    }

    context.fillRect(0, 0, context.canvas.width, context.canvas.height);

    for (let i = 0, len = particles.length; i < len; i++) {
        var particle = particles[i];

        var lp = { x: particle.position.x, y: particle.position.y };

        // set rotation
        particle.offset.x += particle.speed;
        particle.offset.y += particle.speed;

        // follow mouse
        particle.shift.x += (mouseX - particle.shift.x) * particle.speed;
        particle.shift.y += (mouseY - particle.shift.y) * particle.speed;

        // set position
        particle.position.x =
            particle.shift.x +
            Math.cos(i + particle.offset.x) * (particle.orbit * RADIUS_SCALE);
        particle.position.y =
            particle.shift.y +
            Math.sin(i + particle.offset.y) * (particle.orbit * RADIUS_SCALE);

        // limit to screen bounds
        particle.position.x = Math.max(
            Math.min(particle.position.x, SCREEN_WIDTH),
            0
        );
        particle.position.y = Math.max(
            Math.min(particle.position.y, SCREEN_HEIGHT),
            0
        );

        particle.size += (particle.targetSize - particle.size) * 0.05;

        if (Math.round(particle.size) == Math.round(particle.targetSize)) {
            particle.targetSize = 1 + Math.random() * 8;
        }

        context.beginPath();
        context.fillStyle = particle.fillColor;
        context.strokeStyle = particle.fillColor;
        context.lineWidth = particle.size;
        context.moveTo(lp.x, lp.y);
        context.lineTo(particle.position.x, particle.position.y);
        context.stroke();
        context.arc(
            particle.position.x,
            particle.position.y,
            particle.size / 2,
            0,
            Math.PI * 2,
            true
        );
        context.fill();
    }
}

window.onload = init;
