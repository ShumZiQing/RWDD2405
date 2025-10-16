document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".cards-container");
  if (!container) return;

  // Like handler
  container.addEventListener("click", (e) => {
    const likeBtn = e.target.closest(".like-btn");
    if (likeBtn) {
      const tipID = likeBtn.getAttribute("data-id");
      const likeSpan = likeBtn.querySelector("span");
      let count = parseInt(likeSpan.textContent);

      likeSpan.textContent = count + 1;
      likeBtn.disabled = true;

      fetch("likeTip.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `tipID=${tipID}`,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) likeSpan.textContent = data.likes;
          else {
            alert(data.message);
            likeSpan.textContent = count;
          }
        })
        .catch((err) => {
          console.error("Error:", err);
          likeSpan.textContent = count;
        })
        .finally(() => (likeBtn.disabled = false));
    }

    // Delete handler
    const deleteBtn = e.target.closest(".delete-btn");
    if (deleteBtn) {
      const tipID = deleteBtn.getAttribute("data-id");
      const card = deleteBtn.closest(".card");

      if (confirm("Are you sure you want to delete this gardening tip?")) {
        fetch("deleteTip.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `tipID=${tipID}`,
        })
          .then((res) => res.json())
          .then((data) => {
            if (data.success) card.remove();
            else alert(data.message);
          })
          .catch((err) => console.error("Error:", err));
      }
    }
  });
});
