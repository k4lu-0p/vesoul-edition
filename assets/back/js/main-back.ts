// ---------------- EXEMPLE -------------------

let message:string = "Coucou";
let numero:number = 23;

function afficher(mess:string, num:number):string {
    return `le message est ${mess} et le numéro est ${num}`;
}

console.log(afficher(message, numero));
// ---------------------------------------------

let buttonMenu = document.querySelectorAll(".button-menu");
let urlPath:string = window.location.pathname;

let lastUrl:string = (urlPath.split("/")).slice(-1).pop();

if(lastUrl == "admin"){
    for(let i:number ; i<buttonMenu.length ; i++){
        buttonMenu[i].classList.remove("button-active");
    }
buttonMenu[0].classList.add("button-active");
}
if(lastUrl == "commandes"){
    for(let i:number ; i<buttonMenu.length ; i++){
        buttonMenu[i].classList.remove("button-active");
    }
buttonMenu[1].classList.add("button-active");
}
if(lastUrl == "livres"){
    for(let i:number ; i<buttonMenu.length ; i++){
        buttonMenu[i].classList.remove("button-active");
    }
buttonMenu[2].classList.add("button-active");
}
if(lastUrl == "info-boutique"){
    for(let i:number ; i<buttonMenu.length ; i++){
        buttonMenu[i].classList.remove("button-active");
    }
buttonMenu[3].classList.add("button-active");
}
if(lastUrl == "mentions"){
    for(let i:number ; i<buttonMenu.length ; i++){
        buttonMenu[i].classList.remove("button-active");
    }
buttonMenu[4].classList.add("button-active");
}