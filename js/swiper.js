
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 5,
  loop: true,
  //effect: "fade",
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    440: {
      slidesPerView: 1,
    },
    540: {
      slidesPerView: 1,
    },
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 1,
    },
    803: {
      slidesPerView: 1,
    },
    1030: {
      slidesPerView: 1,
    },
    1091: {
      slidesPerView: 1,
    },
    1024: {
      slidesPerView: 1,
    },
  },
});



var swiper = new Swiper(".mySwiper1", {
  slidesPerView: 4,
  centeredSlides: true,
  spaceBetween: 5,
  grabCursor: true,
  breakpoints: {
    440: {
      slidesPerView: 1,
      spaceBetween: 50,
    },
    540: {
      slidesPerView: 2,
      spaceBetween: 50,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 50,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
    803: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
    1030: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
    1091: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
  },
  loop: true,
  loopFillGroupWithBlank: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});


const swiper = new Swiper('.mySwiper', {
  loop: true,
  slidesPerView: 1,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
  },
});