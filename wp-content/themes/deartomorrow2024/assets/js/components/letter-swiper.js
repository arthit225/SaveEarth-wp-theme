import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';


function initializeLetterSwiper() {
  var swiper = new Swiper(".swiper-container", {
    modules: [Navigation], // Load Navigation module
    slidesPerView: 1.5,
    centeredSlides: true,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: ".swiper-next-button",
      prevEl: ".swiper-prev-button",
    },
    breakpoints: {
      576: {
        // width: 576,
        slidesPerView: 2.5,
      },
      768: {
        // width: 768,
        slidesPerView: 4.5,
      },
    }
  });

  (function ($) {
    $(".heading-marquee").marquee({
      //duration in milliseconds of the marquee
      duration: 60000,
      //gap in pixels between the tickers
      gap: 50,
      //time in milliseconds before the marquee will start animating
      delayBeforeStart: 0,
      //true or false - should the marquee be duplicated to show an effect of continues flow
      duplicated: true,
      startVisible: true,
      delayBeforeStart: 500,
    });
  })(jQuery);
}

export default initializeLetterSwiper;
