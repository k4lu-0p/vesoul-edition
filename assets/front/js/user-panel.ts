let checkHomme = document.querySelector(".homme");
let checkFemme = document.querySelector(".femme");

checkHomme.addEventListener('click', () => {
    checkFemme.checked = false;
})

checkFemme.addEventListener('click', () => {
    checkHomme.checked = false;
})