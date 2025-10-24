document.addEventListener("DOMContentLoaded", () => {
  const cityFilter = document.getElementById("cityFilter");
  const typeFilter = document.getElementById("typeFilter");
  const cards = document.querySelectorAll(".card");
  const popup = document.getElementById("contactPopup");
  const closeBtn = popup.querySelector(".close");

  function filterCards() {
    const city = cityFilter.value;
    const type = typeFilter.value;

    cards.forEach(card => {
      const matchCity = (city === "all" || card.dataset.city === city);
      const matchType = (type === "all" || card.dataset.category === type);
      card.style.display = (matchCity && matchType) ? "block" : "none";
    });
  }

  cityFilter.addEventListener("change", filterCards);
  typeFilter.addEventListener("change", filterCards);

  // Contact popup logic
  document.querySelectorAll(".contact-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      document.getElementById("contactName").textContent = btn.dataset.name;
      document.getElementById("contactPhone").textContent = btn.dataset.phone;
      document.getElementById("contactEmail").textContent = btn.dataset.email;
      document.getElementById("contactCity").textContent = btn.dataset.city;
      popup.style.display = "flex";
    });
  });

  closeBtn.addEventListener("click", () => popup.style.display = "none");
  window.addEventListener("click", e => {
    if (e.target === popup) popup.style.display = "none";
  });
});
