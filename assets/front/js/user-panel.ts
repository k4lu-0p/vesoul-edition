let checkHomme = document.querySelector(".homme") as HTMLInputElement;
let checkFemme = document.querySelector(".femme") as HTMLInputElement;

checkHomme.addEventListener('click', () => {
    checkFemme.checked = false;
})

checkFemme.addEventListener('click', () => {
    checkHomme.checked = false;
})