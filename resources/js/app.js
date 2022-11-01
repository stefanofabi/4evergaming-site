import './bootstrap';

import '../sass/app.scss'

import Swiper, { Navigation, Pagination } from 'swiper';

window.Swiper = Swiper;
Swiper.use([Navigation, Pagination]);
