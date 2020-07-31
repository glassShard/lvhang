export function showCurrentPageOnNavbar() {
  const fragments = window.location.href.split('//')[1].split('/');
  fragments.shift();
  if (fragments[0] === 'test') {
    fragments.shift();
  }
  const currentRoute = fragments[0];
	const navList = document.querySelectorAll('.nav-item a');
  
  if (currentRoute === '') {
    navList[0].classList.add('navButtonActive');
    return;
  } 

  const routes = ['home', 'live', 'studio', 'records', 'news', 'contact'];
  const currentIndex = routes.findIndex((element) => element === currentRoute);
  if (currentIndex >= 0) {
    navList[currentIndex].classList.add('navButtonActive');
  }
  return; 
}