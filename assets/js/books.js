function filterBooks() {
	const searchInput = document.getElementById('searchInput');
	const searchValue = searchInput.value.toLowerCase().trim();
	const books = document.querySelectorAll('.books-content .book-item');

	books.forEach((book) => {
		const bookText = book.textContent.toLowerCase();
		book.hidden = !bookText.includes(searchValue);
	});
}

document.addEventListener('DOMContentLoaded', () => {
	const searchInput = document.getElementById('searchInput');

	if (searchInput) {
		searchInput.addEventListener('input', filterBooks);
	}
});
