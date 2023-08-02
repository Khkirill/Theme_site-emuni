"use strict";
import SmoothScroll from "smooth-scroll";
import $ from 'jquery';
// window.$ = window.jQuery = $;
import 'slick-carousel'

// import BackToTop, { scrollFunction } from "./common/backToTop";

export const isIOS = /(iPhone|iPad)/i.test(navigator.platform);
///// AOs Animate
// AOS.init();
window.onload = function() {
  document.body.className += " loaded";
}
document.addEventListener("DOMContentLoaded", () => {
  /////// fixed menu
  const navbar = document.getElementById('fixed-header');
// OnScroll event handler
  if ( $('body').hasClass('error404')) {
    navbar.classList.add("scrolled");
    navbar.classList.add("add-fixed");
  }

  const onScroll = () => {
    const scroll = document.documentElement.scrollTop;

    if (scroll > 50) {
      navbar.classList.add("scrolled");
      setTimeout(function () {
        navbar.classList.add("add-fixed");
      }, 20);
    }else if ( $('body').hasClass('error404')) {
      navbar.classList.add("scrolled");
      navbar.classList.add("add-fixed");
    } else {
      navbar.classList.remove("scrolled");
      navbar.classList.remove("add-fixed");
    }
  };

  // Use the function
  window.addEventListener('scroll', onScroll);


/////////////////
//////// Mobile Menu  ///////
  let menuChildren = document.querySelectorAll('.menu-item-has-children'),
      menuIcon = document.querySelector('.header__burger'),
      menuNav = document.querySelector('.modal__menu'),
      bodyFix = document.querySelector('body'),
      resizeFlag = false
  for (let i = 0; i < menuChildren.length; i++) {
    let spanElem = document.createElement("span");
    spanElem.classList.add('sub-menu-icon');
    menuChildren[i].querySelector('a').insertAdjacentElement('afterEnd', spanElem)
  }
  menuIcon.addEventListener('click', function () {
    this.classList.add('open');
    menuNav.classList.toggle('active');
    bodyFix.classList.toggle('body-fixed');
    if (bodyFix.classList.contains('body-fixed')) {
      resizeFlag = true
    } else {
      resizeFlag = false
    }
  });

  if(menuNav){
    menuNav.addEventListener('click', function (e) {
      if (e.target.classList.contains('sub-menu-icon')) {
        e.target.classList.toggle('open');
        // e.target.nextElementSibling.classList.toggle('active');
        e.target.nextElementSibling.classList.toggle('active');
      }
      if (e.target.classList.contains('menu-close')) {
        closeMenu()
      }
    });
  }
  window.addEventListener('resize', function () {
    if (resizeFlag === true) {
      closeMenu()
    }
  });
  function closeMenu() {
    let subMenu = document.querySelectorAll('.sub-menu');
    menuIcon.classList.remove('open');
    menuNav.classList.remove('active');
    bodyFix.classList.remove('body-fixed');

    for (let i = 0; i < subMenu.length; i++) {
      subMenu[i].classList.remove('active');
      let subMenuIcon = subMenu[i].parentElement.querySelector('.sub-menu-icon');
      if (subMenuIcon !== null) {
        if (subMenuIcon.classList.contains('open')) {
          subMenuIcon.classList.remove('open');
        }
      }
    }
    resizeFlag = false
  }


  // BackToTop();
  // const scrollCallbackFunc = () => {
  //   scrollFunction();
  // };
  //
  // const сallback = () => {
  //   if (isIOS) {
  //     return throttle(scrollCallbackFunc, 50);
  //   } else {
  //     return scrollCallbackFunc;
  //   }
  // };
  //
  // window.addEventListener("scroll", сallback());
  //
  // // smooth scroll to anchor
  //
  // const scroll = new SmoothScroll('a[href*="#"]', {
  //   speed: 500,
  //   speedAsDuration: true,
  // });
  $('a[href^="#"]').on('click',function (e) {
    e.preventDefault();

    var target = $(this.hash);
    $('html, body').stop().animate({
      'scrollTop': target.offset().top
    }, 500);
  });
});

$('.main-first__slider').slick({
    dots: false,
    arrows: false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 300,
    rows: 0,
    slidesToShow: 5,
    slidesToScroll: 1,
    nextArrow: $('.slider__next'),
    prevArrow: $('.slider__prev'),
    // fade: true,
    // cssEase: 'linear',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        }
      }, {
        breakpoint:580,
        settings: {
          slidesToShow: 2,
        }
      }
    ]
  });


