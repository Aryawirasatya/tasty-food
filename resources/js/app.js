import './bootstrap';
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const swiper = new Swiper('.mySwiper', {
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});