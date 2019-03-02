const loader = document.querySelector(".loader");
const wrapperBooks = document.querySelector("#book-collection");

let derniere_position_de_scroll_connue = 0;
let ticking = false;
let page = 1;
let isTrigger = false;

window.addEventListener('DOMContentLoaded', (e) => {
  fetchBooks(page);
});

window.addEventListener('scroll', function (e) {
  derniere_position_de_scroll_connue = window.scrollY;
  if (!ticking) {
    window.requestAnimationFrame(function () {
      onScrollFetch(derniere_position_de_scroll_connue);
      ticking = false;
    });
  }
  ticking = true;
});

function onScrollFetch(position_scroll) {

  if (position_scroll > (wrapperBooks.clientHeight / 3) * 2 && !isTrigger) {

    loader.classList.add("loader-on");
    page++;
    fetchBooks(page);
    
  }
}

function fetchBooks(page) {

  isTrigger = true;

  fetch(`http://localhost:8080/home/load?page=${page}`, {
      method: 'GET'
    })
    .then(res => res.text())
    .then(res => {

      if (!loader.classList.contains("loader-on")) {
        loader.classList.remove("loader-on");
      }
      
      // console.log(res);
      wrapperBooks.innerHTML+= res;
      isTrigger = false;
      
    })
    .catch(err => {
      if (err) throw err;
    })
}