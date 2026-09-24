document.addEventListener('DOMContentLoaded', () => {
	const menuToggle = document.querySelector('.menu-toggle');
	const mainNavigation = document.getElementById('main-navigation');

	if (menuToggle && mainNavigation) {
		menuToggle.addEventListener('click', () => {
			const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

			menuToggle.setAttribute('aria-expanded', String(!isOpen));
			mainNavigation.classList.toggle('is-open', !isOpen);
		});
	}
});
