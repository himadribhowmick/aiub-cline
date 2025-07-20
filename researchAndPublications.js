// script.js

function filterPublications() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const ul = document.getElementById('publications');
  const li = ul.getElementsByTagName('li');

  for (let i = 0; i < li.length; i++) {
    const h3 = li[i].getElementsByTagName('h3')[0];
    const txtValue = h3.textContent || h3.innerText;
    if (txtValue.toLowerCase().indexOf(filter) > -1) {
      li[i].style.display = '';
    } else {
      li[i].style.display = 'none';
    }
  }
}
