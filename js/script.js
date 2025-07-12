document.addEventListener("DOMContentLoaded", function () {
    const images = [
        "images/header1.jpg",
        "images/header2.jpg",
        "images/header3.jpg"
    ];

    let index = 0;
    const header = document.querySelector(".header");

    if (!header) {
        console.error("Header element not found!");
        return;
    }

    function changeBackground() {
        header.style.backgroundImage = `url('${images[index]}')`;
        index = (index + 1) % images.length;
    }

    changeBackground(); // Set initial background
    setInterval(changeBackground, 4000); // Change image every 4 seconds
});
let currentIndex = 0;
const slides = document.querySelector(".slider");

function nextSlide() {
    currentIndex = (currentIndex + 1) % 3;
    updateSlider();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + 3) % 3;
    updateSlider();
}

function updateSlider() {
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}

setInterval(nextSlide, 3000);  // Auto Slide change every 3 seconds
