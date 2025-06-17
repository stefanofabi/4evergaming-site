import './bootstrap';

import { Button, Carousel, Collapse, Modal, Dropdown, Offcanvas, Tab, Toast } from 'bootstrap';
window.Toast = Toast;

import $ from 'jquery';
window.$ = $;

import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

window.Swiper = Swiper;
Swiper.use([Navigation, Pagination]);

// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import Chart from 'chart.js/auto';
window.Chart = Chart;

import 'bootstrap/dist/css/bootstrap.css';

import '../sass/app.scss'


