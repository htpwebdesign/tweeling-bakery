const swiper = new Swiper(".mySwiper", {
  loop: true,
  autoplay: {
    delay: 2000,
  },
  spaceBetween: 10,
  slidesPerView: 2,
  breakpoints: {
    "@0.75": {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    "@1.00": {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 50,
    },
  },
});
