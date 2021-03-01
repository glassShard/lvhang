export function setToken() {
  const element = document.querySelector('#token');
  let token = '';
  if (element) {
    token = document.querySelector('#token').innerHTML;
  }
  if (token) {
    localStorage.setItem('token', token);
  }  
}