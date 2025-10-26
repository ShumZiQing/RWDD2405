document.addEventListener("DOMContentLoaded", () => {
  const favButtons = document.querySelectorAll(".fav-btn");

  favButtons.forEach(button => {
    button.addEventListener("click", async () => {
      const busID = button.dataset.id;

      try {
        const response = await fetch("businessFavAction.php", { // <-- use your PHP file name here
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `busID=${busID}`
        });

        const data = await response.json();

        if (data.success) {
          if (data.liked) {
            button.classList.add("liked");
            button.textContent = "❤️";
          } else {
            button.classList.remove("liked");
            button.textContent = "🤍";
          }
        } else {
          alert(data.message || "Error occurred.");
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Something went wrong. Please try again.");
      }
    });
  });
});
