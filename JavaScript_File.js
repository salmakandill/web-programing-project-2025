const searchIcon = document.getElementById('searchIcon');
const searchInput = document.getElementById('searchInput');

searchIcon.addEventListener('click', () => {
  searchInput.classList.toggle('active');
  if (searchInput.classList.contains('active')) {
    searchInput.focus();
  } else {
    searchInput.value = '';
  }
});

searchInput.addEventListener('keydown', (e) => {
  if (e.key === 'Enter') {
    const query = searchInput.value.trim();
    if (query !== '') {
      filterMangaCards(query);
    }
  }
});

function filterMangaCards(query) {
  const cards = document.querySelectorAll('.manga-card');
  cards.forEach(card => {
    const title = card.textContent.toLowerCase();
    if (title.includes(query.toLowerCase())) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}
