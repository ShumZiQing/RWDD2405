document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", (e) => {
  const likeBtn = e.target.closest(".like-btn");
  if (likeBtn) {
    const tipID = likeBtn.getAttribute("data-id");
    const likeSpan = likeBtn.querySelector("span");
    if (!tipID || !likeSpan) return;

    let current = parseInt(likeSpan.textContent) || 0;
    const isLiked = likeBtn.classList.contains("liked");

    likeBtn.disabled = true;

    if (isLiked) {
      likeBtn.classList.remove("liked");
      likeSpan.textContent = Math.max(current - 1, 0);
    } else {
      likeBtn.classList.add("liked");
      likeSpan.textContent = current + 1;
    }

    fetch("likeGTip.php", {
      method: "POST",
      credentials: "include",
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
          alert(data?.message || 'Could not update like');
          likeSpan.textContent = current;
          if (isLiked) likeBtn.classList.add("liked");
          else likeBtn.classList.remove("liked");
        }
      })
      .catch(err => {
        console.error('Network or parse error:', err);
        likeSpan.textContent = current;
        if (isLiked) likeBtn.classList.add("liked");
        else likeBtn.classList.remove("liked");
      })
      .finally(() => {
        likeBtn.disabled = false;
      });

    return;
  }


    // Delete handler
    const deleteBtn = e.target.closest(".delete-btn");
    if (deleteBtn) {
      const tipID = deleteBtn.getAttribute("data-id");
      const card = deleteBtn.closest(".card");

      if (confirm("Are you sure you want to delete this gardening tip?")) {
        fetch("deleteGTip.php", {
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

  // Join project
  document.addEventListener('DOMContentLoaded', function() {
  const joinBtns = document.querySelectorAll('.join-btn'); // assuming your button has this class

  joinBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();

      const prjID = this.dataset.id; // button should have data-id attribute
      const msgBox = document.getElementById('join-message');

      // clear previous message
      msgBox.innerHTML = '';

      fetch('joinProject.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'prjID=' + encodeURIComponent(prjID)
      })
      .then(res => res.text())
      .then(html => {
        msgBox.innerHTML = html;
      })
      .catch(() => {
        msgBox.innerHTML = "<div class='error-msg'>Something went wrong. Try again later.</div>";
      });
    });
  });
});
});
