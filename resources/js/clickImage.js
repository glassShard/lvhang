export function clickImage(clickableImage, index) {

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
}
