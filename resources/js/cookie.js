export function setCookie() {
  const accepted = document.querySelector('#acceptCookies');
  const cookieDiv = document.querySelector('.cookie-wrapper');
  const cookies = document.cookie.split(';');

  if (!cookies.includes('cookiesAccepted=true') && cookieDiv) {
    cookieDiv.classList.remove('hidden');
  } else {
    document.cookie = "cookiesAccepted=true; Max-Age=2592000";
  }
  
  if (accepted) {
    accepted.addEventListener('click', () => {
      document.cookie = "cookiesAccepted=true; Max-Age=2592000";
      cookieDiv.classList.add('hidden');
    });
  }
  
}