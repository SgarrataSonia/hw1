function userJson(json) {
    if(json.esito == true) {
        document.querySelector('.username span').textContent = "Nome utente già esistente!";
        document.querySelector('.username span').classList.add('error');
    } 
    else 
    {
        document.querySelector('.username span').textContent = "";
        document.querySelector('.username span').classList.remove('error');
    }
}

function emailJson(json) {
    if(json.esito == true) {
      document.querySelector('.email span').textContent = 'E-mail già usata!';
      document.querySelector('.email span').classList.add('error');
    } 
    else 
    {
      document.querySelector('.email span').textContent = '';
      document.querySelector('.email span').classList.remove('error');
    }
  }

function onResponse(response) {
    return response.json();
}

function checkNome(event) {
    const name = event.currentTarget;

    if(name.value.length == 0) {
        name.parentNode.parentNode.querySelector("span").textContent = "Non hai scritto bene il tuo nome";
        name.parentNode.parentNode.querySelector("span").classList.add("error");
    }
    else 
    {
        name.parentNode.parentNode.querySelector("span").textContent = "";
        name.parentNode.parentNode.querySelector("span").classList.remove("error");
    }
}

function checkCognome(event) {
    const surname = event.currentTarget;

    if(surname.value.length == 0) {
        surname.parentNode.parentNode.querySelector("span").textContent = "Non hai scritto bene il tuo cognome";
        surname.parentNode.parentNode.querySelector("span").classList.add("error");
    }
    else 
    {
        surname.parentNode.parentNode.querySelector("span").textContent = "";
        surname.parentNode.parentNode.querySelector("span").classList.remove("error");
    }
}

function checkUsername(event) {
    const user = event.currentTarget;

    if(!/[a-zA-Z0-9]{1,16}/.test(user.value)) {
        user.parentNode.parentNode.querySelector("span").textContent = "Username non valido!";
        user.parentNode.parentNode.querySelector("span").classList.add("error");
    }
    else 
    {
        const u = encodeURIComponent(user.value);
        fetch("check_username.php?q="+u).then(onResponse).then(userJson);
    }
}

function checkEmail(event) {
    const em = event.currentTarget;

    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(em.value)) {
        em.parentNode.parentNode.querySelector("span").textContent = "Email non valida!";
        em.parentNode.parentNode.querySelector("span").classList.add("error");
    }
    else 
    {
        const e = encodeURIComponent(em.value);
        fetch("check_email.php?q="+e).then(onResponse).then(emailJson);
    }
}

function checkPsw(event) {
    const psw = event.currentTarget;

    if(psw.value.length < 8) {
        psw.parentNode.parentNode.querySelector("span").textContent = "Password troppo corta";
        psw.parentNode.parentNode.querySelector("span").classList.add("error");
    }
    else 
    {
        psw.parentNode.parentNode.querySelector("span").textContent = "";
        psw.parentNode.parentNode.querySelector("span").classList.remove("error");
    }
}

function checkConfPsw(event) {
    const conf_psw = event.currentTarget;
    const passw = document.querySelector(".password input");

    if(conf_psw.value === passw.value) {
        conf_psw.parentNode.parentNode.querySelector('span').textContent = '';
        conf_psw.parentNode.parentNode.querySelector('span').classList.remove('errore');
    } 
    else 
    {
        conf_psw.parentNode.parentNode.querySelector('span').textContent = 'Le password non coincidono';
        conf_psw.parentNode.parentNode.querySelector('span').classList.add('errore');
    }
}

// Aggiungo listener agli input del signup
const nome = document.querySelector(".names .nome input");
nome.addEventListener("blur", checkNome);
const cognome = document.querySelector(".names .cognome input");
cognome.addEventListener("blur", checkCognome);
const username = document.querySelector(".username input");
username.addEventListener("blur", checkUsername);
const email = document.querySelector(".email input");
email.addEventListener("blur", checkEmail);
const password = document.querySelector(".password input");
password.addEventListener("blur", checkPsw);
const conferma_psw = document.querySelector(".conferma_psw input");
conferma_psw.addEventListener("blur", checkConfPsw);