import './bootstrap';

import { Button, Carousel, Collapse, Modal, Dropdown, Offcanvas, Tab, Toast } from 'bootstrap';
window.Toast = Toast;

import $ from 'jquery';
window.$ = $;

import Swiper, { Navigation, Pagination } from 'swiper';
window.Swiper = Swiper;
Swiper.use([Navigation, Pagination]);

import Chart from '~chart.js/auto';
window.Chart = Chart;

import '../sass/app.scss'


