const menuToggle = document.querySelector(".menu-toggle");
const dropdownNav = document.querySelector(".dropdown-nav");

menuToggle.addEventListener("click", () => {
  dropdownNav.style.display =
    dropdownNav.style.display === "block" ? "none" : "block";
});
