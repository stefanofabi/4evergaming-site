import './bootstrap';

import 'bootstrap';

import $ from 'jquery';
window.$ = $;

import '../sass/app.scss'

import Swiper, { Navigation, Pagination } from 'swiper';

window.Swiper = Swiper;
Swiper.use([Navigation, Pagination]);
