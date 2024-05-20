function handleConcertClick(event) {
  const clickedListItem = event.currentTarget;
  const concertId = clickedListItem.dataset.concertId;
  const url = `konser_detail.php?id=${concertId}`;
  window.location.href = url;
}

const concertListItems = document.querySelectorAll('li[data-concert-id]');
concertListItems.forEach(listItem => {
  listItem.addEventListener('click', handleConcertClick);
});