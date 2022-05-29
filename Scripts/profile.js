
// Casella di input
const insert = document.createElement('input');
insert.setAttribute("type", "text");

// Bottone di conferma 
const confirm = document.createElement('input');
confirm.setAttribute("class", "confirm_button")
confirm.setAttribute("type", "submit");
confirm.setAttribute("value", "Conferma");

function onClickNome() 
{
    const formNome = document.querySelector("#nome");

    insert.setAttribute("name", "new_nome");

     // Aggiungo quello che ho creato al div apposito
    formNome.appendChild(insert);
    formNome.appendChild(confirm);
}

function onClickCognome() 
{
    const formCognome = document.querySelector("#cognome");

    insert.setAttribute("name", "new_cognome");
    
    // Aggiungo quello che ho creato al div apposito
    formCognome.appendChild(insert);
    formCognome.appendChild(confirm);
}

function onClickUsername() 
{
    const formUsername = document.querySelector("#username");

    insert.setAttribute("name", "new_username");
    
    // Aggiungo quello che ho creato al div apposito
    formUsername.appendChild(insert);
    formUsername.appendChild(confirm);
}

function onClickEmail() 
{
    const formEmail = document.querySelector("#email");

    insert.setAttribute("name", "new_email");
    
    // Aggiungo quello che ho creato al div apposito
    formEmail.appendChild(insert);
    formEmail.appendChild(confirm);
}

function onClickPsw() 
{
    const formPsw = document.querySelector("#password");
    
    insert.setAttribute("name", "new_psw");

    // Aggiungo quello che ho creato al div apposito
    formPsw.appendChild(insert);
    formPsw.appendChild(confirm);
}

const button_nome = document.querySelector("#mod_nome");
button_nome.addEventListener("click", onClickNome);

const button_cognome = document.querySelector("#mod_cognome");
button_cognome.addEventListener("click", onClickCognome);

const button_username = document.querySelector("#mod_username");
button_username.addEventListener("click", onClickUsername);

const button_email = document.querySelector("#mod_email");
button_email.addEventListener("click", onClickEmail);

const button_password = document.querySelector("#mod_psw");
button_password.addEventListener("click", onClickPsw);