let derniere_position_de_scroll_connue = 0;
let ticking = false;
const loader = document.querySelector('.loader');
let wrapperBooks = document.querySelector('#container-books');
let page;

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
  console.log(wrapperBooks.style.height);

  if (position_scroll > (wrapperBooks.height / 3) * 2) {

    loader.classList.add("loader-on");

    page++;

    console.log(page);

    // fetch(`http://localhost:8080/home/load?page=${page}`, {
    //     method: 'GET'
    // })
    // .then(res => res.text())
    // .then(res => {
    //     loader.classList.remove("loader-on");
    //     console.log(res);
    // })
    // .catch(err => {
    //     if (err) throw err;
    // })
  }
}