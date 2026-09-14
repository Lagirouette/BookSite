function filterBooks() {
	const searchValue = document.getElementById('searchInput').value.toLowerCase().trim();
	const books = document.querySelectorAll('.books-content article');

	books.forEach((book) => {
		const bookText = book.textContent.toLowerCase();
		book.hidden = !bookText.includes(searchValue);
	});
}
