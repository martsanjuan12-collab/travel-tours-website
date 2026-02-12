const navToggle = document.querySelector("[data-nav-toggle]");
const navLinks = document.querySelector("[data-nav-links]");
const searchForm = document.querySelector("[data-search-form]");
const searchInput = document.querySelector("[data-search-input]");
const tourCards = Array.from(document.querySelectorAll("[data-tour-card]"));

const renderStars = (rating) => {
  const fullStars = Math.floor(rating);
  const halfStar = rating % 1 >= 0.5;
  let stars = "";

  for (let i = 0; i < fullStars; i += 1) {
    stars += "★";
  }

  if (halfStar) {
    stars += "☆";
  }

  while (stars.length < 5) {
    stars += "☆";
  }

  return stars;
};

const updateRatings = () => {
  document.querySelectorAll("[data-rating]").forEach((ratingEl) => {
    const ratingValue = Number(ratingEl.dataset.rating || 0);
    const starsEl = ratingEl.querySelector(".stars");
    if (starsEl) {
      starsEl.textContent = renderStars(ratingValue);
    }
  });
};

const filterTours = (term) => {
  const normalizedTerm = term.trim().toLowerCase();
  if (!normalizedTerm) {
    tourCards.forEach((card) => {
      card.style.display = "flex";
    });
    return;
  }

  tourCards.forEach((card) => {
    const text = card.textContent.toLowerCase();
    card.style.display = text.includes(normalizedTerm) ? "flex" : "none";
  });
};

if (navToggle && navLinks) {
  navToggle.addEventListener("click", () => {
    navLinks.classList.toggle("open");
  });
}

if (searchForm && searchInput) {
  searchForm.addEventListener("submit", (event) => {
    event.preventDefault();
    filterTours(searchInput.value);
  });

  searchInput.addEventListener("input", () => {
    filterTours(searchInput.value);
  });
}

updateRatings();
