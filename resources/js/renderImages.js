export function renderImages() {
  const container = document.querySelector('.imagesPreviewContainer');
  if (!container) {
    return;
  }
  const images = Array.from(container.children);

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
        img.width = Math.ceil(img.height / img.naturalHeight * img.naturalWidth);
      } else {
        img.width = Math.floor(img.height / img.naturalHeight * img.naturalWidth);
      }
      widthSum += img.width;

      if (index === array.length - 1) {
        img.width += container.clientWidth-widthSum;
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
        img.width = Math.ceil(img.height / img.naturalHeight * img.naturalWidth);
      });
    } else {
      modArray[modArray.length - 1].width = container.clientWidth - (modArray.reduce((acc, curr) => {
        return acc + curr.width;
      }, 0) - modArray[modArray.length - 1].width);
    }
  });

}