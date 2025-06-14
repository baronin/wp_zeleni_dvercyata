import Swiper from 'swiper';
import 'swiper/swiper-bundle.min.css';

const customSwiper = new Swiper('.swiper', {
  direction: 'vertical',
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

export default customSwiper;
