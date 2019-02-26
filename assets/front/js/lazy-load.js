window.addEventListener('click', (event) => {
    
    fetch('http://localhost:8080/home/load', { method: 'GET' })
    .then(res =>  res.text())
    .then(res => {
        console.log(res);
    })
    .catch(err => {
        if (err) throw err;
    })
})