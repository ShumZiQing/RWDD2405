// auto-slide for carousel
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
