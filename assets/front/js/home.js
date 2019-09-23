//Variables globales de la page home ====================================

const bookCollection = document.querySelector('#book-collection');
const filterButtons = document.querySelectorAll('.expand-button');
const genra = document.querySelector('#genra-list');
const genraButton = document.querySelector('#expand-genra');
const author = document.querySelector('#author-list');
const authorButton = document.querySelector('#expand-author');
const slider = document.querySelector('#year-slider');
const yearButton = document.querySelector('#expand-year');
let itemList = document.getElementById('sort-select');

//=======================================================================

//Objets de la page home ================================================

class filters {
    constructor(news, price, genra, author){
        this.news = false;
        this.price = [];
        this.genra = [];
        this.author = [];
    }
    //Getter
    get news(){

    }
    //Setter

    //Method

}

class book {
    constructor(image, title, author, year, price, news){
        this.image = '';
        this.title = '';
        this.author = {
            'firstname' : '', 
            'lastname' : ''
        };
        this.year = 0;
        this.price = 0;
        this.news = false;
    }
    //Getter

    //Setter

    //Method
}
//=======================================================================

// Scripts executés au chargement =======================================

window.onload = function(){

    // Ouverture des sections de filtrage
    filterButtons.forEach((elem)=>{
        elem.addEventListener('click', (e)=>{
        
            e.preventDefault();
    
            let activeButton = e.target.id;
            let button = '';
            let target = '';

            switch(activeButton){
                case 'expand-genra' :
                    button = genraButton;
                    target = genra;
                    break;
                case 'expand-year' :
                    button = yearButton;
                    target = slider;
                    break;
                case 'expand-author' :
                    button = authorButton;
                    target = author;
                    break;
            }
            
            displayFilters(button, target);
        });
    })
    
    // création du Slider pour les années
    // noUiSlider.create(slider, {
    //     start: [20, 80],
    //     connect: true,
    //     range: {
    //         'min': 0,
    //         'max': 100
    //     }
    // });

    // Ecoute de la selection du tri apres chargement de la page   
    itemList.addEventListener('change', ()=>{

        let activeOption = itemList.value;
        let route = '';

        // Routeur pour le trie des livres affichés
        switch(activeOption){
            case  'ascName' :
                route = '/ascName';
                break;
            case 'descName' :
                route = '/descName';
                break;
            case 'ascYear' :
                route = '/ascYear';
                break;
            case 'descYear' :
                route = '/descYear';
                break;
        }

        fetchNewOrder(route, bookCollection);
        
    })
}

//=======================================================================

// Fonctions ============================================================

// Fonction qui va chercher en Ajax le nouvel ordre des livres à afficher
function fetchNewOrder(route, target){
    
    let url = 'http://localhost:8080'.concat(route);

    fetch(url, {
        method: 'POST',
    })
    .then(res => res.json())
    .then(data => {

        displayBooks(target, data);

    })
    .catch((err) => { if (err) throw err;})
}

//Fonction qui applique les filtres au livres 
// function applyFilters(){

// }

//Fonction qui affiche les livres dans le DOM
function displayBooks(target, content){
    
    let strContent = content.join('');
    console.log(strContent);
    target.innerHTML = strContent;

}

//Fonction d'affichage/masquage des filtres
function displayFilters(button, target)
{
        button.classList.toggle('active');
        target.classList.toggle('active');
}

//========================================================================