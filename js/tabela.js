function mostrar() {
    let popup = document.getElementById("mensagem-index");
    popup.classList.add("show");

    setTimeout(() => {
        fechar();
    }, 5000);
}

function fechar() {
    let popup = document.getElementById("mensagem-index");
    popup.classList.remove("show");

    setTimeout(() => {
        location.reload();
    }, 1000);
}

setTimeout(mostrar, 50);


function pesquisar() {
    let input = document.getElementById('buscar').value.toLowerCase(); 
    let tabela = document.getElementById('tabela');
    let linhas = tabela ? tabela.getElementsByTagName('tr') : []; 
    let encontrou = false; 

    if (!tabela) {
        document.querySelector('.erro').style.display = 'flex';
        return;
    }

    for (let i = 1; i < linhas.length; i++) {
        let td_cpf = linhas[i].getElementsByTagName('td')[1];
        let td_nome = linhas[i].getElementsByTagName('td')[2];
        let td_celular = linhas[i].getElementsByTagName('td')[3]; 
        let td_email = linhas[i].getElementsByTagName('td')[4];

        if (td_cpf || td_nome || td_celular || td_email) {
            let cpfText = td_cpf.textContent.toLowerCase();
            let nomeText = td_nome.textContent.toLowerCase();
            let celularText = td_celular.textContent.toLowerCase();
            let emailText = td_email.textContent.toLowerCase();

            if (cpfText.includes(input) || nomeText.includes(input) || celularText.includes(input) || emailText.includes(input)) {
                linhas[i].style.display = ''; 
                encontrou = true; 
            } else {
                linhas[i].style.display = 'none'; 
            }
        }
    }

    if (!encontrou) {
        tabela.style.display = 'none'; 
        let erroDiv = document.querySelector('.erro');
        if (!erroDiv) {
            erroDiv = document.createElement('div');
            erroDiv.className = 'erro';
            erroDiv.innerHTML = "<img src='icon/erro.gif'><h2>Nenhum usuário encontrado!</h2>";
            tabela.parentNode.appendChild(erroDiv);
        }
        erroDiv.style.display = 'flex'; 
    } else {
   
        tabela.style.display = ''; 
        let erroDiv = document.querySelector('.erro');
        if (erroDiv) {
            erroDiv.style.display = 'none'; 
        }
    }
}