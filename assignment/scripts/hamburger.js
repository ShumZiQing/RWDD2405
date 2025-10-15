document.addEventListener("DOMContentLoaded", () => {
  // HAMBURGER DROPDOWN
  const menuToggle = document.querySelector(".menu-toggle");
  const dropdownNav = document.querySelector(".dropdown-nav");

  if (menuToggle && dropdownNav) {
    menuToggle.addEventListener("click", () => {
      dropdownNav.classList.toggle("active");
    });
  }

  // PROFILE DROPDOWN
  const profileDropdown = document.querySelector(".profile-dropdown");
  if (profileDropdown) {
    const button = profileDropdown.querySelector(".profile-btn");
    const menu = profileDropdown.querySelector(".dropdown-menu");

    button.addEventListener("click", () => {
      menu.classList.toggle("active");
    });
  }
});
