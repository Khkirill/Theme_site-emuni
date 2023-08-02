document.addEventListener("DOMContentLoaded", () => {

  function burgerMenu(selector) {
    let menu = $(selector);
    let button = menu.find('.header__burger');
    let openMenu = menu.find('.header__modal');
    let menuLinkClick = menu.find('.modal__menu a');

    button.on('click', (e) => {
      e.preventDefault();
      toggleMenu();
    });
    menuLinkClick.on('click', () => toggleMenu());

    function toggleMenu(){
      openMenu.toggleClass('active');
      button.toggleClass('burger-active');
    }
  }
  burgerMenu('body');

});
