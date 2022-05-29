

function toggleMobileMenu(menu) {
    menu.classList.toggle("open");
}


function onResponse(response) {
    return response.json();
}

function onJsonResult(json) {
    console.log(json);
}

function onJsonResponse(json) {
    const section = document.querySelector("#contents");
    section.innerHTML = "";

    for(let i in json) {

        const id = json[i].id;
        const title = json[i].titolo;
        const url_image = json[i].url;
        const description = json[i].descrizione;

        const divRicetta = document.createElement("div"); // contenitore "grande"
        divRicetta.setAttribute("class", "ricetta");

        const div_id = document.createElement("div"); // contenitore ID
        div_id.setAttribute("class", "nascosto"); // ELEMENTO NASCOSTO CHE SERVE SOLO PER LA GESTIONE DEI PREFERITI

        const div_sx =  document.createElement("div"); // contenitore immagine
        div_sx.setAttribute("class", "sx");

        const div_dx =  document.createElement("div"); // contenitore testo e bottone
        div_dx.setAttribute("class", "dx");
        
        
        // Creazione id
        const p_id = document.createElement("p");
        p_id.setAttribute("class", "id");
        p_id.textContent = id;
        // Creazione immagine
        const immagine = document.createElement("img");
        immagine.src = url_image;
        // Creazione titolo
        const titolo = document.createElement("p");
        titolo.setAttribute("class", "titolo");
        titolo.textContent = title;
        // Creazione descrizione
        const descrizione = document.createElement("p");
        descrizione.setAttribute("class", "descrizione");
        descrizione.textContent = description;
        // Creazione bottone aggiunta preferiti
        const add_ricettario = document.createElement("a");
        add_ricettario.innerText = "Aggiungi al ricettario";
        add_ricettario.setAttribute("class", "button_ricettario");
        add_ricettario.addEventListener('click', addRicettario);

        //Append ID
        div_id.appendChild(p_id);
        // Append immagine
        div_sx.appendChild(immagine);
        // Append testo e bottone
        div_dx.appendChild(titolo);
        div_dx.appendChild(descrizione);
        div_dx.appendChild(add_ricettario);
        
        // Append al contenitore
        divRicetta.appendChild(div_id);
        divRicetta.appendChild(div_sx);
        divRicetta.appendChild(div_dx);

        // Inserimento nella pagina
        section.appendChild(divRicetta);
    }
}

function addRicettario(event) {
    const button = event.currentTarget;

    const formData = new FormData();
    formData.append('id', button.parentNode.parentNode.querySelector('.nascosto .id').textContent);
    formData.append('immagine', button.parentNode.parentNode.querySelector('img').src);
    formData.append('titolo', button.parentNode.querySelector('.titolo').textContent);
    formData.append('descrizione', button.parentNode.querySelector('.descrizione').textContent);

    fetch("add_ricettario.php", {method: 'post', body: formData}).then(onResponse).then(onJsonResult);
}

function carica_contenuti() {
    fetch("carica_contenuti.php").then(onResponse).then(onJsonResponse);
}

// Chiamata non appena aperta la pagina HOME
carica_contenuti();