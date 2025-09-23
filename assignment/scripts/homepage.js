// auto-slide for carousel (it dont even auto one)
const track = document.querySelector('.carousel');
if (track) {
  let index = 0;
  setInterval(() => {
    index = (index + 1) % track.children.length;
    track.scrollTo({
      left: track.children[index].offsetLeft,
      behavior: "smooth"
    });
  }, 4000);
}
