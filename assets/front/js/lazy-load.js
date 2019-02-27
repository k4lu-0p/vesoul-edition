window.addEventListener('click', (event) => {

})

let derniere_position_de_scroll_connue = 0;
let ticking = false;

function faitQuelquechose(position_scroll) {
    if (position_scroll == 200) {
        fetch('http://localhost:8080/home/load', {
            method: 'GET'
        })
        .then(res => res.text())
        .then(res => {
            console.log(res);
        })
        .catch(err => {
            if (err) throw err;
        })
    }
}

window.addEventListener('scroll', function(e) {
  derniere_position_de_scroll_connue = window.scrollY;
  if (!ticking) {
    window.requestAnimationFrame(function() {
      faitQuelquechose(derniere_position_de_scroll_connue);
      ticking = false;
    });
  }
  ticking = true;
});