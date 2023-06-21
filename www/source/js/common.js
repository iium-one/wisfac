//Tab버튼
const tabAddOnClass = (element, callback) => {
  const buttons = element.closest(".tabs").querySelectorAll('.tabs-btn');

  buttons.forEach(button => {
    button.classList.remove('on');
  });

  element.classList.add('on');

  if (typeof callback === 'function') {
    callback();
  }
}

export { tabAddOnClass }