const bookCollection = document.querySelector('#book-collection');
let itemList = document.getElementById('sort-select');

window.onload = function(){
    // Ecoute de la selection du tri apres chargement de la page   
    itemList.addEventListener('change', ()=>{

        let activeOption = itemList.value;
        let route = '';
        // Routeur pour 
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
        // console.log(reply);
        // displayBooks(reply);
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


//Fonction qui affiche le nouvelle ordre des livres
// function displayBooks()
// {

// }