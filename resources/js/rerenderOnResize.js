import {renderImages} from "./renderImages";

export function rerenderOnResize(timeouts) {
  let resizeTimer = false;
  window.addEventListener('resize', () => {
    if (!resizeTimer) {
      resizeTimer = true;
      renderImages(timeouts);
      setTimeout(() => {
        resizeTimer = false;
        renderImages(timeouts);
      }, 500);
    }
  })
}