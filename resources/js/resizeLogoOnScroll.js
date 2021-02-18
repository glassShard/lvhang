export function resizeLogoOnScroll() {
  
  let scrollTimer;
  let lastScrollFireTime;
  
  // kell a scrollozáskor logo összanyomáshoz
	const logoHolder = document.querySelector('.logo-holder');
	const logoHolderOrigPadding = getComputedStyle(logoHolder).paddingBottom;
  const logoHolderOrigPaddingNr = +logoHolderOrigPadding.substring(0, logoHolderOrigPadding.length - 2);
  const scrollButton = document.querySelector('.topScroller');

	// scrollozáskor meghívja a szükséges függvényeket
	document.addEventListener('scroll', () => push());

  push();  

  // scrollozáskor átméretezi a logót, megjeleníti a felscrollozó gombot
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
      const navbar = document.querySelector('.nav-bar');

      if (scrollTop > 100) {
        scrollButton.style.display = 'block';
        setTimeout(() => {
          scrollButton.style.opacity = '1';
        }, 1);  
      } else {
        scrollButton.addEventListener('transitionend', hideElement);
        scrollButton.style.opacity = '0';

        function hideElement(event) {
          if (event.propertyname === 'opacity') {
            scrollButton.style.display = 'none';
            scrollButton.removeEventListener('transitionend', hideElement);
          } 
        }
      }

      if (hamburgerDisplay === 'none') {
        if (scrollTop > 0 & scrollTop < headerOuterHeight - 60) {
          const paddingToSet = 10 + (logoHolderOrigPaddingNr - 10) * ((headerOuterHeight - 60 - scrollTop) / (headerOuterHeight - 60));

          // const paddingToSet = 10;

          header.style.height = headerOuterHeight - scrollTop + 'px';
          header.style.position = 'relative';
          header.style.background = 'transparent';

          if (scrollTop > headerOuterHeight / 3) {
            navbar.style.transform = 'translateX(-80px)';
          } else {
            navbar.style.transform = 'translateX(0px)';
          }
                    
          logoHolder.style.paddingBottom = paddingToSet + 'px';
          logoHolder.style.paddingTop = paddingToSet + 'px';
        }

        if (scrollTop === 0) {
          header.style.height = '100%';
          header.style.position = 'relative';
          header.style.background = 'transparent';
          navbar.style.transform = 'translateX(0px)';

          logoHolder.style.paddingBottom = '30px';
          logoHolder.style.paddingTop = '30px';

/*           logoHolder.style.paddingBottom = '10px';
          logoHolder.style.paddingTop = '10px'; */
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
          navbar.style.transform = 'translateX(-80px)';
      
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