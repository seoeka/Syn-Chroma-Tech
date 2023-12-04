function myFunction() {
    var containerMenu = document.querySelector('.container-menu-xs');
    containerMenu.style.display = (containerMenu.style.display === 'block') ? 'none' : 'block';
}

var cmxClose = document.querySelector('.cmx-close');
cmxClose.addEventListener('click', function() {
    var containerMenu = document.querySelector('.container-menu-xs');
    containerMenu.style.display = 'none';
});

//main-slider
document.addEventListener("DOMContentLoaded", function () {
    const sliderImages = document.querySelector(".slider-img");
    const sliderNav = document.querySelector(".slider-nav");
    const intervalTime = 5000; // Set the interval time in milliseconds

    // Function to update the active slider navigation button
    function updateSliderNav() {
      const slides = document.querySelectorAll(".slider-img img");
      slides.forEach((slide, index) => {
        if (slide.getBoundingClientRect().left === 0) {
          const navButtons = document.querySelectorAll(".slider-nav a");
          navButtons.forEach((button) => {
            button.classList.remove("active");
          });
          navButtons[index].classList.add("active");
        }
      });
    }

    // Function to move the slider images to the next slide
    function nextSlide() {
      const firstSlide = document.querySelector(".slider-img img:first-child");
      const cloneSlide = firstSlide.cloneNode(true);
      sliderImages.appendChild(cloneSlide);
      sliderImages.scrollBy({
        left: firstSlide.clientWidth,
        behavior: "smooth",
      });
    }

    // Event listener for updating the active slider navigation button on scroll
    sliderImages.addEventListener("scroll", function () {
      if (sliderImages.scrollLeft % sliderImages.clientWidth === 0) {
        updateSliderNav();
      }
    });

    // Event listener for updating the active slider navigation button on navigation button click
    sliderNav.addEventListener("click", function (event) {
      if (event.target.tagName === "A") {
        const navButtons = document.querySelectorAll(".slider-nav a");
        navButtons.forEach((button) => {
          button.classList.remove("active");
        });
        event.target.classList.add("active");
      }
    });

    // Set an interval to move to the next slide
    setInterval(nextSlide, intervalTime);

    updateSliderNav();
});

