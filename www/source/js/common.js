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

// [plugin-mCustomScrollbar]
const mcScrollbar = (target_id) => {
  let $target = $(`#${target_id}`);
  if($target.length > 0){
    $target.mCustomScrollbar({
      theme:"minimal",
      setTop: 0,
      axis: "y",
      alwaysShowScrollbar: 1
    });
  }
}

export { tabAddOnClass, mcScrollbar }