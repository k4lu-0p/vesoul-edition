const bookCollection = document.querySelector('#book-collection');
const filterButtons = document.querySelectorAll('.expand-button');
const genra = document.querySelector('#genra-list');
const genraButton = document.querySelector('#expand-genra');
const author = document.querySelector('#author-list');
const authorButton = document.querySelector('#expand-author');
const slider = document.querySelector('#year-slider');
const yearButton = document.querySelector('#expand-year');
let itemList = document.getElementById('sort-select');

window.onload = function(){

    // Ouverture des boutons
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
                console.log(route);
                break;
            case 'descName' :
                route = '/descName';
                console.log(route);
                break;
            case 'ascYear' :
                route = '/ascYear';
                console.log(route);
                break;
            case 'descYear' :
                route = '/descYear';
                console.log(route);
                break;
        }

        fetchNewOrder(route, bookCollection);
        
    })
}

// Fonction qui va chercher en Ajac le nouvel ordre des livres à afficher
function fetchNewOrder(route, target)
{
    let url = 'http://localhost:8080'.concat(route);

    console.log(url);

    fetch(url, {
        method: 'POST',
    })
    .then(res => res.json())
    .then(data => {

        console.log(data);
        target.innerHTML = data

    })
    .catch((err) => { if (err) throw err;})
}


function displayFilters(button, target)
{
        button.classList.toggle('active');
        target.classList.toggle('active');
}