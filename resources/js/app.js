'use strict';

import {renderImages, cloneImages} from "./renderImages";
import Swiper from 'swiper/bundle';
import {showCurrentPageOnNavbar} from "./showCurrentPageOnNavbar";
import {openCloseRefCheckOnGalleryEdit, addEventListenerToRadios} from "./openCloseRefCheckOnGalleryEdit";
import { setCookie } from "./cookie";
import { openCloseSearch } from "./search";
import { resizeLogoOnScroll } from "./resizeLogoOnScroll";
import { rerenderOnResize } from "./rerenderOnResize";

require('bootstrap');

window.onload = function () {
	const timeouts = [];

	const body = document.querySelector('body');
	const scrollButton = document.querySelector('.topScroller');
	
	//cloneImages();
	renderImages(timeouts);
	showCurrentPageOnNavbar();
	setCookie();
	openCloseRefCheckOnGalleryEdit();
	addEventListenerToRadios();
	openCloseSearch();
	resizeLogoOnScroll();
	rerenderOnResize(timeouts);

	// scrollToTop

	scrollButton.addEventListener('click', () => window.scroll({
		top: 0,
		behavior: 'smooth'
	}));
	
	// hamburger menü nyitás-zárás

	function openHamburger() {
		const navBar = document.querySelector('.nav-bar');		
		
		hamburger.classList.toggle('hamburger-open');
		body.classList.toggle('modal-open');
		bodyOverlay.classList.toggle('hidden');
		navBar.classList.toggle('open-nav-bar');
		navBar.classList.toggle('closed-nav-bar');
	}
	
	const bodyOverlay = document.querySelector('.body-overlay');
	const hamburger = document.querySelector('.hamburger');
	hamburger.addEventListener('click', openHamburger);
	bodyOverlay.addEventListener('click', openHamburger);

	/* képgalériánál ha képre kattintok */
	const swiperContainer = document.querySelector('.mySwiper');
	const clickableImages = document.querySelectorAll('.clickableImage');
	
	clickableImages.forEach((clickableImage, index) => {
		clickableImage.addEventListener('click', (event) => {
			body.classList.add('modal-open');
			const swiper = new Swiper('.swiper-container', {
				// Optional parameters
				loop: true,
				lazy: true,
				initialSlide: index,
				init: false,
			
				// If we need pagination
				pagination: {
					el: '.swiper-pagination',
					dynamicBullets: true
				},
			
				// Navigation arrows
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
			});

			function initSwiper() {
				// swiper.lazy.loadInSlide(index);
				swiper.init();
				
				swiperContainer.removeEventListener('transitionend', initSwiper);
			}
		
			swiperContainer.addEventListener('transitionend', initSwiper);

			function destroySwiper() {
				swiper.destroy();
				swiperContainer.removeEventListener('transitionend', destroySwiper);
			}
			
			document.querySelector('.galleryExit').addEventListener('click', () => {
				body.classList.remove('modal-open');
				swiperContainer.addEventListener('transitionend', destroySwiper);
				swiperContainer.classList.remove('active');
			});
			swiperContainer.classList.add('active');
		})
	});
}    
