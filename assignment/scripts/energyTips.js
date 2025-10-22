document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab-btn");
  const lists = document.querySelectorAll(".tips-list");

  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      tabs.forEach(btn => btn.classList.remove("active"));
      lists.forEach(list => list.classList.remove("active"));

      tab.classList.add("active");

      const target = document.getElementById(tab.dataset.target);
      if (target) target.classList.add("active");
    });
  });

document.addEventListener("click", (e) => {
  // LIKE BUTTON
  const likeBtn = e.target.closest(".like-btn");
  if (likeBtn) {
    const id = likeBtn.dataset.id;
    const countSpan = likeBtn.querySelector("span");

    fetch("likeETip.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "eTipID=" + encodeURIComponent(id)
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          countSpan.textContent = data.likes;

          if (data.liked) {
            likeBtn.classList.add("liked");
          } else {
            likeBtn.classList.remove("liked");
          }
        } else {
          alert(data.message || "Unable to like this tip.");
        }
      })
      .catch(() => alert("Error: Could not connect to server."));
  }

  // DELETE BUTTON
  const deleteBtn = e.target.closest(".delete-btn");
  if (deleteBtn) {
    const id = deleteBtn.dataset.id;
    const card = deleteBtn.closest(".tip-card");

    if (confirm("Are you sure you want to delete this tip?")) {
      fetch("deleteETip.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "etipID=" + encodeURIComponent(id)
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            card.remove();
          } else {
            alert(data.message || "Unable to delete this tip.");
          }
        })
        .catch(() => alert("Error: Could not connect to server."));
    }
  }
});
});
