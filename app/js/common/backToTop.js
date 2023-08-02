"use strict";

const button = document.getElementById("backToTop");

export const scrollFunction = () => {
  if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
    button.style.display = "flex";
  } else {
    button.style.display = "none";
  }
};

const BackToTop = () => {
  const topFunction = () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  };

  button.addEventListener("click", topFunction);
};

export default BackToTop;
