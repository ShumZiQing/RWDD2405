document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".cards-container");
  if (!container) return;

  container.addEventListener("click", (e) => {
    const favBtn = e.target.closest(".fav-btn");
    if (favBtn) {
      const busID = favBtn.getAttribute("data-id");

      fetch("toggleBusinessLike.php", {
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
});
