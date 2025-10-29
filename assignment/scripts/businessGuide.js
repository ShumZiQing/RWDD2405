document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".cards-container");
  if (!container) return;

  //Favourite button
  container.addEventListener("click", (e) => {
    const favBtn = e.target.closest(".fav-btn");
    if (favBtn) {
      const busID = favBtn.getAttribute("data-id");

      fetch("businessFavAction.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `busID=${busID}`,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            favBtn.classList.toggle("liked", data.liked);
            favBtn.textContent = data.liked ? "❤️" : "🤍";
          } else {
            alert(data.message);
          }
        })
        .catch((err) => console.error("Error:", err));
    }
  });

  // Filters
  const cityFilter = document.getElementById("cityFilter");
  const categoryFilter = document.getElementById("categoryFilter");
  const cards = document.querySelectorAll(".card");

  function applyFilters() {
    const selectedCity = cityFilter.value.trim().toLowerCase();
    const selectedCategory = categoryFilter.value.trim().toLowerCase();

    cards.forEach((card) => {
      const typeElem = card.querySelector(".type");
      const locationElem = card.querySelector(".location");

      // Get the text, remove emoji
      const cardCategory = typeElem ? typeElem.textContent.replace("📝", "").trim().toLowerCase() : "";
      const cardCity = locationElem ? locationElem.textContent.replace("📍", "").trim().toLowerCase() : "";

      const matchCity = !selectedCity || cardCity === selectedCity.toLowerCase();
      const matchCategory = !selectedCategory || cardCategory === selectedCategory.toLowerCase();

      card.style.display = matchCity && matchCategory ? "flex" : "none";
    });
  }

  cityFilter.addEventListener("change", applyFilters);
  categoryFilter.addEventListener("change", applyFilters);
});
