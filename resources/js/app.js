'use strict';

import {renderImages} from "./renderImages";
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

const root = "http://localhost/lvhang-sitebuild/";

let scrollTimer;
let lastScrollFireTime;

window.onload = function () {

	renderImages();

	// kell a scrollozáskor logo összanyomáshoz
	const logoHolder = document.querySelector('.logo-holder');
	const logoHolderOrigPadding = getComputedStyle(logoHolder).paddingBottom;
	const logoHolderOrigPaddingNr = +logoHolderOrigPadding.substring(0, logoHolderOrigPadding.length - 2);

	// scrollozáskor meghívja a szükséges függvényeket
	document.addEventListener('scroll', () => push())

	window.dispatchEvent(new CustomEvent('scroll'));

	// scrollozáskor átméretezi a logót
	function push() {
		const minScrollTime = 20;
		let now = new Date().getTime();

		function processScroll() {
			const scrollTop = document.documentElement.scrollTop;
			const headerOuterHeight = document.querySelector('.header-outer').clientHeight;
			const header = document.querySelector('.header');
			const hamburgerElement = document.querySelector('.hamburger');
			const hamburgerDisplay = getComputedStyle(hamburgerElement).display;
			const logoHolder = document.querySelector('.logo-holder');

			if (hamburgerDisplay === 'none') {
				if (scrollTop > 0 & scrollTop < headerOuterHeight - 60) {
					const paddingToSet = 10 + (logoHolderOrigPaddingNr - 10) * ((headerOuterHeight - 60 - scrollTop) / (headerOuterHeight - 60));

					header.style.height = headerOuterHeight - scrollTop + 'px';
					header.style.position = 'relative';
					header.style.background = 'transparent';
					
					logoHolder.style.paddingBottom = paddingToSet + 'px';
					logoHolder.style.paddingTop = paddingToSet + 'px';
				}

				if (scrollTop === 0) {
					header.style.height = '100%';
					header.style.position = 'relative';
					header.style.background = 'transparent';

					logoHolder.style.paddingBottom = '30px';
					logoHolder.style.paddingTop = '30px;'
				}

				if (scrollTop >= headerOuterHeight - 60) {
					if (header.style.position === 'relative') {
						header.style.position = 'fixed';
						header.style.top = '0px';
						header.style.zIndex = '10';
						header.style.height = '60px';
						header.style.background = 'black';
				
						logoHolder.style.paddingBottom = '10px';
						logoHolder.style.paddingTop = '10px';
					}
				}
			} 
		}

		if (!scrollTimer) {
			if (now - lastScrollFireTime > (minScrollTime) || !lastScrollFireTime) {
				processScroll();
				lastScrollFireTime = now;;
			}
			scrollTimer = true;
			setTimeout(() => {
				scrollTimer = false;
				lastScrollFireTime = new Date().getTime();
				processScroll();
			}, minScrollTime);
		}
	};

	// hamburger menü nyitás-zárás

	function openHamburger() {
		const body = document.querySelector('body');
		
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
				swiper.init();
				swiperContainer.removeEventListener('transitionend', initSwiper);
			}
		
			swiperContainer.addEventListener('transitionend', initSwiper);

			function destroySwiper() {
				swiper.destroy();
				swiperContainer.removeEventListener('transitionend', destroySwiper);
			}
			
			document.querySelector('.galleryExit').addEventListener('click', () => {
				swiperContainer.addEventListener('transitionend', destroySwiper);
				swiperContainer.classList.remove('active');
			});
			swiperContainer.classList.add('active');

		})
	});
}    
