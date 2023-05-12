const switchFooter = () => {
  const windowWidth = window.innerWidth;

  if (windowWidth > 1000) {
    ElementDisplay.change("mobile-footer", "none");
    ElementDisplay.change("desktop-footer", "block");
  } else if (windowWidth <= 1000) {
    ElementDisplay.change("mobile-footer", "block");
    ElementDisplay.change("desktop-footer", "none");
  }
};

window.addEventListener("DOMContentLoaded", switchFooter);
window.addEventListener("resize", switchFooter);
