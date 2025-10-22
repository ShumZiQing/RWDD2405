document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".cards-container");
  if (!container) return;

  container.addEventListener("click", (e) => {
    // --- LIKE handler (uses closest so clicks on span/emoji still count)
    const likeBtn = e.target.closest(".like-btn");
    if (likeBtn) {
      const tipID = likeBtn.getAttribute("data-id");
      const likeSpan = likeBtn.querySelector("span");
      if (!tipID || !likeSpan) return;

      let current = parseInt(likeSpan.textContent) || 0;
      const isLiked = likeBtn.classList.contains("liked");

      // optimistic UI
      likeBtn.disabled = true;
      if (isLiked) {
        likeBtn.classList.remove("liked");
        likeSpan.textContent = Math.max(current - 1, 0);
      } else {
        likeBtn.classList.add("liked");
        likeSpan.textContent = current + 1;
      }

      fetch("likeTip.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `tipID=${encodeURIComponent(tipID)}`
      })
      .then(res => res.json())
      .then(data => {
        console.log('likeTip response', data);
        if (data && data.success) {
          likeSpan.textContent = data.likes;
          if (data.liked) likeBtn.classList.add("liked");
          else likeBtn.classList.remove("liked");
        } else {
          // revert optimistic change on error
          alert(data && data.message ? data.message : 'Could not update like');
          if (isLiked) {
            // originally liked, revert to liked
            likeBtn.classList.add("liked");
            likeSpan.textContent = current;
          } else {
            likeBtn.classList.remove("liked");
            likeSpan.textContent = current;
          }
        }
      })
      .catch(err => {
        console.error('Network or parse error:', err);
        // revert optimistic update
        if (isLiked) {
          likeBtn.classList.add("liked");
          likeSpan.textContent = current;
        } else {
          likeBtn.classList.remove("liked");
          likeSpan.textContent = current;
        }
      })
      .finally(() => {
        likeBtn.disabled = false;
      });

      return; // stop — prevent delete handler below from running for same click
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
