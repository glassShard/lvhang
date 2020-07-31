export function openCloseRefCheckOnGalleryEdit() {
  const stRef = document.querySelector('.st-ref');
  if (stRef === null) {
    return;
  }
  const studioRadioButton = document.querySelector('input[id="foot2"]');
  let selectedValue;
  if (studioRadioButton.checked) {
    selectedValue = studioRadioButton.value;
    stRef.style.height = 'unset';
    return;
  }
  stRef.style.height = '0';
  document.querySelector('input[id="ref"]').checked = false;
}

export function addEventListenerToRadios() {
  const radios = document.querySelectorAll('input[name="foot"]');
  radios.forEach((radio) => {
    radio.addEventListener('click', openCloseRefCheckOnGalleryEdit);
  });
}