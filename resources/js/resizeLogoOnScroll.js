export function resizeLogoOnScroll() {
  
  let scrollTimer;
  let lastScrollFireTime;
  
  // kell a scrollozáskor logo összanyomáshoz
	const logoHolder = document.querySelector('.logo-holder');
	const logoHolderOrigPadding = getComputedStyle(logoHolder).paddingBottom;
	const logoHolderOrigPaddingNr = +logoHolderOrigPadding.substring(0, logoHolderOrigPadding.length - 2);

	// scrollozáskor meghívja a szükséges függvényeket
	document.addEventListener('scroll', () => push());

  push();  

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
          logoHolder.style.paddingTop = '30px';
        }

        if (scrollTop >= headerOuterHeight - 60) {

          if (header.style.position === 'fixed') {
            return;
          }

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

    if (!scrollTimer) {
      if (now - lastScrollFireTime > (minScrollTime) || !lastScrollFireTime) {
        processScroll();
        lastScrollFireTime = now;
      }
      scrollTimer = true;
      setTimeout(() => {
        scrollTimer = false;
        lastScrollFireTime = new Date().getTime();
        processScroll();
      }, minScrollTime);
    }
  }


}