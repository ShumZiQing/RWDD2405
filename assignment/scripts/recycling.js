document.addEventListener("DOMContentLoaded", () => {
  const filter = document.getElementById("filter")
  const cards = document.querySelectorAll(".program-card");


  filter.addEventListener("change", () => {
    const value = filter.value;
    cards.forEach(card => {
      if (value === "all" || card.dataset.material === value) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});