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
});
