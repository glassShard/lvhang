export function renderImages(timeouts) {
  const container = document.querySelector('.imagesPreviewContainer');
  if (!container) {
    return;
  }
  timeouts.map((timeout) => {
    clearTimeout(timeout)
  });
  const images = Array.from(container.children);
  images.forEach((image) => {
    image.children[0].height = '120';
    image.children[0].style.width = 'auto';
    image.style.opacity = 0;
  });

  const reducedContainer = images.reduce((acc, curr) => {
    if (acc.length === 0) {
      acc.push([curr]);
    } else {
      const totalWidth = acc[acc.length - 1].reduce((innerAcc, innerCurr) => {
        return innerAcc + innerCurr.offsetWidth;
      }, 0);
      if (totalWidth + curr.offsetWidth < container.clientWidth) {
        acc[acc.length - 1].push(curr);
      } else {
        acc.push([curr]);
      }
    }
    return acc;
  }, []);

  reducedContainer.map(array => {
    const imagesWidth = array.reduce((acc, curr) => acc + curr.offsetWidth, 0);
    const ratio = array[0].offsetWidth / imagesWidth;
    const newWidth = ratio * container.clientWidth;
    const growRatio = newWidth / array[0].offsetWidth;
    let widthSum = 0;
    const modArray = array.map((imageWrapper, index) => {
      const imageWrapperHeight = (growRatio * imageWrapper.offsetHeight);
      const img = imageWrapper.children[0];
      img.height = imageWrapperHeight;
      if (index % 2 === 0) {
        img.style.width = Math.ceil(img.height / img.naturalHeight * img.naturalWidth) + 'px';
      } else {
        img.style.width = Math.floor(img.height / img.naturalHeight * img.naturalWidth) + 'px';
      }
      widthSum += img.width;

      if (index === array.length - 1) {
        img.style.width = img.width + container.getBoundingClientRect().width-widthSum + 'px';
      }
      return imageWrapper;
    });


    if (array === reducedContainer[reducedContainer.length - 1] && imagesWidth < container.clientWidth / 2) {
      array.map(imageWrapper => {
        const img = imageWrapper.children[0];
        if (reducedContainer.length > 1) {
          img.height = reducedContainer[reducedContainer.length - 2][0].offsetHeight;
        } else {
          img.height = 120;
        }
        img.style.width = Math.ceil(img.height / img.naturalHeight * img.naturalWidth) + 'px';
      }) + 'px';
    } else {
      modArray[modArray.length - 1].width = container.clientWidth - (modArray.reduce((acc, curr) => {
        return acc + curr.width;
      }, 0) - modArray[modArray.length - 1].width);
    }
  });

  for (let i = 0; i < images.length; i++) {
    const timeout = (images.length - 1 - i) * 20;
    images[i].style.transform = 'translateY(-200px)';
    timeouts.push(setTimeout(() => {
      images[i].style.opacity = '1';
      images[i].style.transform = 'translateY(0)';
      images[i].style.transition = 'all 0.3s';
    }, timeout));
  }

}

