

function onResponse(response) {
    return response.json();
}

function removePrefJson(json) {
    if(json.esito == true) {
      const result = document.querySelector('#div_prefers');
      result.innerHTML = '';
      caricaRicettario();
    }
  }

function removeRicettario(event) {
    const button = event.currentTarget;

    const formData = new FormData();
    formData.append('id', button.parentNode.parentNode.querySelector('.nascosto .id').textContent);

    fetch("remove_prefers.php", {method: 'post', body: formData}).then(onResponse).then(removePrefJson);
}

function onPrefJson(json) {
    const preferiti = document.querySelector("#div_prefers");
    preferiti.innerHTML = "";

    for(let i in json) {
        const id = json[i].id;
        const title = json[i].titolo;
        const url_image = json[i].immagine;
        const description = json[i].descrizione;

        const divRicetta = document.createElement("div"); // contenitore "grande"
        divRicetta.setAttribute("class", "ricetta");

        const div_id = document.createElement("div"); // contenitore ID
        div_id.setAttribute("class", "nascosto");
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
        // Creazione bottone rimuovi
        const remove_ricettario = document.createElement("a");
        remove_ricettario.innerText = "Rimuovi";
        remove_ricettario.setAttribute("class", "button_rimuovi");
        remove_ricettario.addEventListener('click', removeRicettario);

         //Append ID
         div_id.appendChild(p_id);
         // Append immagine
         div_sx.appendChild(immagine);
         // Append testo e bottone
         div_dx.appendChild(titolo);
         div_dx.appendChild(descrizione);
         div_dx.appendChild(remove_ricettario);
         
         // Append al contenitore
         divRicetta.appendChild(div_id);
         divRicetta.appendChild(div_sx);
         divRicetta.appendChild(div_dx);
 
         // Inserimento nella pagina
         preferiti.appendChild(divRicetta);
    }

}

function caricaRicettario() {
    fetch("carica_prefers.php").then(onResponse).then(onPrefJson);
}

function onSongJson(json) {
    const songs = document.querySelector('#results');
    songs.innerHTML = '';
    const risultato = json.tracks.items;
  
    for(let i in risultato) {

      const track_data = risultato[i];

      const track = track_data.name;
      const artist = track_data.artists[0].name;
      const imm_album = track_data.album.images[1].url;

      const song = document.createElement('div');
      song.classList.add('song');

      const img = document.createElement('img');
      img.classList.add('img_song');
      img.src = imm_album;
      const titolo = document.createElement('span');
      titolo.classList.add('song_title');
      titolo.textContent = track;
      const artista = document.createElement('span');
      artista.classList.add('artista');
      artista.textContent = artist;
      
      song.appendChild(img);
      song.appendChild(titolo);
      song.appendChild(artista);

      songs.appendChild(song);
    }
}
  
function Research(event) {
    event.preventDefault();
    
    const canzone = document.querySelector('#song');
    const titolo = encodeURIComponent(canzone.value);

    fetch("API_search.php?q="+titolo).then(onResponse).then(onSongJson);
}
  

// Caricamento ricette aggiunte ai preferiti
caricaRicettario();

// Ricerca di una canzone
const ricerca = document.querySelector('#search');
ricerca.addEventListener('submit', Research);