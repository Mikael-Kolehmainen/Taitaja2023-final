const desktopVersion = document.getElementById("desktop-description-image");
const mobileVersion = document.getElementById("mobile-description-image");

const switchDescriptionImage = () => {
  const windowWidth = window.innerWidth;

  if (windowWidth > 1000) {
    ElementDisplay.change("desktop-description-image", "flex");
    ElementDisplay.change("mobile-description-image", "none");
    ElementDisplay.change("description-image-btn-mobile", "none");
  } else if (windowWidth <= 1000) {
    ElementDisplay.change("desktop-description-image", "none");
    ElementDisplay.change("mobile-description-image", "flex");
    ElementDisplay.change("description-image-btn-mobile", "block");
  }
};

window.addEventListener("DOMContentLoaded", switchDescriptionImage);
window.addEventListener("resize", switchDescriptionImage);
