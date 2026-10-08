const filterButtons = document.querySelectorAll(".filter-button");
const destinationCards = document.querySelectorAll(".destination-card");
const images = document.querySelectorAll("img");
const siteHeader = document.querySelector(".site-header");

filterButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const filter = button.dataset.filter;

    filterButtons.forEach((item) => {
      item.classList.toggle("active", item === button);
    });

    destinationCards.forEach((card) => {
      const isVisible = filter === "semua" || card.dataset.category === filter;
      card.classList.toggle("hidden", !isVisible);
    });
  });
});

images.forEach((image) => {
  image.addEventListener("error", () => {
    image.classList.add("is-missing");
    image.removeAttribute("src");
  });
});

window.addEventListener("scroll", () => {
  siteHeader.classList.toggle("scrolled", window.scrollY > 0);
});
