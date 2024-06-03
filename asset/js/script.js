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

// utk hamburger button
const mainMenu = document.querySelector('.mainMenu');
const closeMenu = document.querySelector('.closeMenu');
const openMenu = document.querySelector('.openMenu');
const menu_items = document.querySelectorAll('nav .mainMenu li a');
openMenu.addEventListener('click',show);
closeMenu.addEventListener('click',close);
// untuk tutup menu pas klik salah satu menu item
menu_items.forEach(item => {
    item.addEventListener('click',function(){
        close();
    })
})
function show(){
    mainMenu.style.display = 'flex';
    mainMenu.style.top = '0';
}
function close(){
    mainMenu.style.top = '-100%';
}