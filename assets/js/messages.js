document.addEventListener('DOMContentLoaded', () => {
	const messagesLayout = document.querySelector('.messages-layout');
	const conversationBack = document.querySelector('.conversation__back');

	if (!messagesLayout || !conversationBack) {
		return;
	}

	conversationBack.addEventListener('click', (event) => {
		if (window.matchMedia('(max-width: 800px)').matches) {
			event.preventDefault();
			messagesLayout.classList.remove('messages-layout--conversation');
			messagesLayout.classList.add('messages-layout--list');
			history.pushState({}, '', '/messages');
		}
	});
});