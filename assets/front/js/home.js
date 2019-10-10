
//Variables globales de la page home ====================================

const bookCollection = document.querySelector('#book-collection');
const checkNews = document.querySelector('#news');
const filterButtons = document.querySelectorAll('.expand-button');
const genra = document.querySelector('#genra-list');
const author = document.querySelector('#author-list');
const checksFilter = document.querySelectorAll('#genra-list .form-check-input, #author-list .form-check-input ');
const genraButton = document.querySelector('#expand-genra');
const authorButton = document.querySelector('#expand-author');
const slider = document.querySelector('#year-slider');
const yearButton = document.querySelector('#expand-year');
const itemList = document.getElementById('sort-select');
const loader = document.querySelector(".loader");
const wrapperBooks = document.querySelector("#book-collection");
const btnApplyFilter = document.querySelector("#applyFilter");
const btnDesactivateFilter = document.querySelector("#desactivateFilter");
const sliderYear = document.querySelectorAll('.range');
const btnSearch = document.querySelector('.btn-search');
const inptSarch = document.querySelector('.search-bar');

const filter = {
  title: '',
  nouveaute: false,
  genre: [],
  author: [],
  year:{
    min: 0,
    max: 0
  }
}

let totalPages = 0;
let page = 1;
let ticking = false;
let orderBy = 'ascName';
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

window.addEventListener('load', function(){

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
    });

    //Récupération des années
    applyYearFilter();
    
    
    fetchBooks();
    ticking = true;

    
});

// Ecoute de la selection du tri apres chargement de la page   
itemList.addEventListener('change', ()=>{

  orderBy = itemList.value;
  page = 1;

  wrapperBooks.innerHTML = '';
  loader.classList.add("loader-on");
  fetchBooks();
  ticking = true;
  
});


//=============================================
//Activation on non de la fonction nouveauté
checkNews.addEventListener('change', function(){
  filter.nouveaute = !filter.nouveaute;
  orderBy = itemList.value;
  page = 1;

  wrapperBooks.innerHTML = '';
  loader.classList.add("loader-on");
  fetchBooks();
  ticking = true;
})

//=============================================
//Sur clique des cases genres 
for( let item of checksFilter){
  item.addEventListener('change', (evt)=>{
    
    const  elChecked = evt.currentTarget;
    let choiceId = elChecked.getAttribute('id');
    let  typeFilter = elChecked.dataset.type;
    const zoneBadge = document.querySelector('#badges');

    if( elChecked.checked ){
      
      filter[typeFilter].push(choiceId);
      

      //ajout du bagde      
      const newBadge = document.createElement('div');
      const listClass = ['badge-filter', 'px-2',  'd-flex', 'align-items-center', 'mr-1', 'mb-1'];
      const newBadgeTexte = document.createElement('p');
      const listClassTexte = ['m-0', 'p-0', 'mr-2'];
      const newBadgeClose = document.createElementNS('http://www.w3.org/2000/svg','svg');
      const listClassClose = ['svg-inline--fa', 'fa-times-circle', 'fa-w-16'];
      const newBadgeClosePath = document.createElementNS('http://www.w3.org/2000/svg','path');
      
      newBadge.classList.add(...listClass);
      newBadge.setAttribute('data-value', choiceId );
      newBadge.addEventListener('click', evt => {

        baliseHasClicked = evt.currentTarget;        
        choiceId = baliseHasClicked.dataset.value;
        baliseHasClicked.remove();
        inputWantDesactivate = document.querySelector('#'+ choiceId );
        inputWantDesactivate.checked = false;
        typeFilter = inputWantDesactivate.dataset.type
        removeAndUpdateFilter(choiceId, typeFilter);
      });
      
      newBadgeTexte.classList.add(...listClassTexte);
      newBadgeTexte.innerText = choiceId;
      newBadge.appendChild(newBadgeTexte);

      newBadgeClose.classList.add(...listClassClose);
      newBadgeClose.setAttribute('aria-hidden', "true");
      newBadgeClose.setAttribute('data-prefix', "fas");
      newBadgeClose.setAttribute('data-icon', "times-circle");
      newBadgeClose.setAttribute('role', "img");
      newBadgeClose.setAttribute('viewBox', "0 0 512 512");
      newBadgeClose.setAttribute('data-fa-i2svg', "");
      newBadge.appendChild(newBadgeClose);
      
      
      newBadgeClosePath.setAttribute('fill', "currentColor");
      newBadgeClosePath.setAttribute('d', "M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z");
      newBadgeClose.appendChild(newBadgeClosePath);      
      zoneBadge.appendChild(newBadge);

    }else{
      
      removeAndUpdateFilter(choiceId, typeFilter);
      badge = zoneBadge.querySelector('div[data-value="'+choiceId+'"]');
      badge.remove();
    }
    
    
    
    
  });
}


//=================================================
//Apllique les filtres de recherches
btnApplyFilter.addEventListener('click', function(){
  applyYearFilter();
  orderBy = itemList.value;
  page = 1;

  wrapperBooks.innerHTML = '';
  loader.classList.add("loader-on");
  fetchBooks();
  ticking = true;
});


btnDesactivateFilter.addEventListener('click', () => {

  resetFilter();

});



btnSearch.addEventListener('click', (evt) =>{
  resetFilter('search');
});

inptSarch.addEventListener('keyup', (evt) => {
  
  //Récup des éléments du script
  element = evt.currentTarget;
  autocomplete = document.querySelector('.search-autocomplete');

  //test si on appui sur la touche return et si c'est le cas on sort de l'événement
  if( (evt.keyCode || evt.which) == 13   ){
    evt.preventDefault();
    return false;
  }

  //Tester si moins de 3 caractères saisie
  if( element.value.trim().length < 3 ){
    if( autocomplete !== null ){
      autocomplete.remove();
    }

    return;
  }

  
    
  //On récupère le contenu saisie
  filter.title = element.value;

  //appel ajax
  fetch(`/home/search/ajax/${filter.title}`)
  .then( response => {

    //Si pas de réponse 
    if(response.status === 204 ){
      
      //on supprime la liste
      if( autocomplete !== null ){
        autocomplete.remove();
      }

      //on arrête la promesse
      throw new Error('handled');

    }

    //Conversion en json si reponse
    return response.json();

  })
  .then( data => {

    //on va vérifier si on n'est null
    if( data === null   ){
      
      if( autocomplete !== null){
        autocomplete.remove();
      }

      return;
    }
    


    
    //on va créer créer la zone autocomplete
    if( document.querySelector('.search-autocomplete') === null ){
      formSearch = document.querySelector('.form-search');
      autocomplete = document.createElement('div');
      autocomplete.style.position = 'absolute';
      autocomplete.style.top = element.offsetHeight+"px";
      autocomplete.style.left = ( element.offsetLeft  ) +"px";
      autocomplete.style.width = (element.offsetWidth ) +"px";
      autocomplete.style.minHeight = "100px";
      autocomplete.style.backgroundColor = "#fff";
      autocomplete.style.borderLeft = "solid #00BCD4 1px";
      autocomplete.style.borderRight = "solid #00BCD4 1px";
      autocomplete.style.zIndex = 10;
      autocomplete.classList.add('search-autocomplete');
      formSearch.appendChild(autocomplete);
    }

    listPropositionExist = autocomplete.querySelectorAll('.search-autocomplete-proposition');
    
    for( item of listPropositionExist){
      item.remove();
    }

    for( item of data.books ){      
      newP = document.createElement('p');
      newP.innerText = item.title;
      newP.setAttribute('data-title' , item.title );
      newP.classList.add('search-autocomplete-proposition');
      newP.addEventListener('click', evt => {
        elementHasClicked = evt.currentTarget;
        element.value = elementHasClicked.innerText;
        autocomplete.remove();
      })
      autocomplete = document.querySelector('.search-autocomplete');
      autocomplete.appendChild(newP);
    }


  })
  .catch(error => {
    console.log(error);
  });

  


});

function removeAndUpdateFilter(choiceId, typeFilter){

  
  indexInArrayGenre = filter[typeFilter].findIndex( (element)=>  element == choiceId );
  filter[typeFilter].splice(indexInArrayGenre,1);

}


function resetFilter(action=''){
  //Désactiver new
  if( checkNews.checked == true ){
    checkNews.checked = false;
    filter.nouveaute = false;
  } 

  //Désactiver les années
  initialValues = resetSlider();
  filter.year.min = initialValues[0];
  filter.year.max = initialValues[1];


 //Désactiver les genres et auteurs
  for( let item of checksFilter ){
    if( item.checked === true ){
      item.checked = false;
    }
  }

  badgeFilter = document.querySelectorAll('.badge-filter');
  for( let item of badgeFilter){
    item.remove();
  }

  filter.genre = [];
  filter.author = [];

  searchBar = document.querySelector('.search-bar');

  if( action === 'search'){
    titleBook = searchBar.value;
    filter.title = titleBook;
  }else{
    //on annule la barre de recherche
    searchBar.value = '';
    filter.title= '';
  }
  

  //on recharge la page
  orderBy = itemList.value;
  page = 1;

  wrapperBooks.innerHTML = '';
  loader.classList.add("loader-on");
  fetchBooks();
  ticking = true;
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


function applyYearFilter(){
    amount = document.querySelector('#amount');
    years  = amount.value.split('-');
    filter.year.min = years[0].trim();
    filter.year.max = years[1].trim();
}

//========================================================================





  
  window.addEventListener('scroll', function (e) {
    pageHeight = document.querySelector('.wrapper').offsetHeight;
    footer = document.querySelector('footer').offsetHeight;
    windowHeight = window.innerHeight;
    scrollPosition = window.scrollY ||  window.pageYOffset || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0 );
    if( (pageHeight-footer) <= windowHeight+scrollPosition ){
      if( page <= totalPages ){
        if (ticking === false) {
          onScrollFetch();
          ticking = true;
        }
      }
    }
  });
  
  function onScrollFetch() {    
    if( page <= totalPages ){
      if(ticking === false){
        loader.classList.add("loader-on");
        fetchBooks();
      } 
    } 
  }
  
  function fetchBooks() {
    
    if(ticking === false){

      fetch(`home/load?page=${page}&orderBy=${orderBy}&new=${filter.nouveaute}&genre=${[...filter.genre]}&author=${[...filter.author]}&yearmin=${filter.year.min}&yearmax=${filter.year.max}&title=${filter.title}`, {
          method: 'GET'
        })
        .then(res => {      
          const totalBooks = res.headers.get('X-TotalBooks');
          totalPages = res.headers.get('X-TotalPage');
          elTotalBooks = document.querySelector('#totalPage')
          elTotalBooks.innerHTML = totalBooks;
          return res.text();
          
        })
        .then(res => {
  
          if (loader.classList.contains("loader-on")) {
            loader.classList.remove("loader-on");
  
          }
          
          
          wrapperBooks.innerHTML+= res;
          ticking = false;
          page++;
          
          
        })
        .catch(err => {
          if (err) throw err;
        });
    }
  }


  
    